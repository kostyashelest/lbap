<?php
declare(strict_types=1);

namespace App\Services;

use App\Dto\PaymentCreateDto;
use App\Enums\PaymentMethod;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ReferralPaymentService
{
    private PaymentType $type;
    private Transaction $transaction;
    private string $commissionAmount;

    public function __construct(private CommissionService $commissionService, private PaymentService $paymentService)
    {
    }

    /**
     * @param Transaction $transaction
     * @return void
     */
    public function handle(Transaction $transaction): void
    {
        $this->type = PaymentType::whereName('referral_commission')->first();
        $this->transaction = $transaction;
        $this->commissionAmount = $transaction->commission_amount < 0
            ? bcmul($transaction->commission_amount, '-1', 8)
            : $transaction->commission_amount;

        Log::channel('payment')->info('create (referral payment) - trying create new payment');
        Log::channel('payment')->info('create (referral payment) - transaction id: ' . $this->transaction->id);

        try {
            // If transaction does not have commission
            if (bccomp($this->commissionAmount, '0', 8) <= 0) {
                Log::channel('payment')->info('create (referral payment) - transaction does not have commission');

                return;
            }

            // If transaction user not referral
            if (UserService::isReferralUser($this->transaction->payment->user) === false) {
                Log::channel('payment')->info('create (referral payment) - transaction user not referral');

                return;
            }

            // If commission already paid referrer
            if ($this->isParentTransactionExists()) {
                Log::channel('payment')->info('create (referral payment) - this commission already paid');

                return;
            }

            // If referrer commission less than 0.00000001
            if (bccomp($this->getReferrerCommissionFullAmount(), '0.00000001', 8) <= 0) {
                Log::channel('payment')->info('create (referral payment) - referrer commission less than 0.00000001');

                return;
            }

            // If create payment
            if ($this->createPayment()) {
                Log::channel('payment')->info('create (referral payment) - success referral payment created');

                return;
            }

            Log::channel('payment')->error('create (referral payment) - error referral payment created');

            return;
        } catch (Exception $exception) {
            Log::channel('payment')->error('create (referral payment) - error while creating new payment');
            Log::channel('payment')->error($exception->getMessage());
            Log::channel('payment')->error($exception->getTraceAsString());
        }

    }

    /**
     * @return bool
     */
    private function isParentTransactionExists(): bool
    {
        return Payment::where('parent_id', '=', $this->transaction->id)
            ->where('payment_type_id', '=', $this->type->id)
            ->exists();
    }

    /**
     * @return bool
     */
    private function createPayment(): bool
    {
        $dto = new PaymentCreateDto();
        $dto->user = User::find($this->transaction->payment->user->referrer);
        $dto->type = $this->type->id;
        $dto->method = PaymentMethod::TOP_UP;
        $dto->fullAmount = $this->getReferrerCommissionFullAmount();
        $dto->parentId = $this->transaction->id;

        if ($this->paymentService->handle($dto)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private function getReferrerCommissionFullAmount(): string
    {
        return bcmul(
            $this->commissionAmount,
            $this->commissionService->getReferralCommission(),
            8
        );
    }
}
