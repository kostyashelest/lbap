<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Http\Requests\PaymentUpdateRequest;
use App\Models\Payment;

class PaymentUpdateService
{
    /**
     * @param PaymentUpdateRequest $request
     * @return bool
     */
    public function handle(PaymentUpdateRequest $request, Payment $payment): bool
    {
        if (self::isClosePayment($payment)) {
            return false;
        }

        if (($request->has('cancel') && self::closePayment($payment))) {
            return true;
        }

        if (($request->has('confirm') && self::paidPayment($payment))) {
            return true;
        }

        return false;
    }

    /**
     * @param $payment
     * @return bool
     */
    private static function isClosePayment($payment): bool
    {
        return $payment->status === PaymentStatus::PAID ||
            $payment->status === PaymentStatus::EXPIRED ||
            $payment->status === PaymentStatus::CANCEL;
    }

    /**
     * @param $payment
     * @return bool
     */
    private static function closePayment($payment): bool
    {
        $payment->status = PaymentStatus::CANCEL;

        if ($payment->save()) {
            return true;
        }

        return false;
    }

    /**
     * @param $payment
     * @return bool
     */
    private static function paidPayment($payment): bool
    {
        $payment->status = PaymentStatus::PAID;

        if ($payment->save()) {
            return true;
        }

        return false;
    }
}