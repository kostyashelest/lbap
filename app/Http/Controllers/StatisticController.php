<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    /**
     * @return View
     */
    public function user(): View
    {
        $statistics = DB::table('users')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->paginate(30);

        return view('admin.statistic.user', [
            'statistics' => $statistics,
        ]);
    }

    /**
     * @return View
     */
    public function finance(): View
    {
        $statistics = DB::table('payments')
            ->select(
                DB::raw('DATE(paid_at) as date'),
                DB::raw('
                    (select sum(full_amount)
                        from payments
                        where DATE(paid_at) = date) as full_amount,
                   (select sum(amount)
                        from payments
                        where DATE(paid_at) = date) as amount,
                    (select sum(abs(commission_amount))
                        from payments
                        where DATE(paid_at) = date) as commission_amount
                ')
            )
            ->whereNotNull('paid_at')
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->paginate(30);

        $totalPaymentWithdrawSum = Payment::whereStatus(PaymentStatus::PAID)
            ->where('method', '=', PaymentMethod::WITHDRAW)
            ->sum('full_amount');

        $totalPaymentTopUpSum = Payment::whereStatus(PaymentStatus::PAID)
            ->where('method', '=', PaymentMethod::TOP_UP)
            ->sum('amount');

        $balanceDifference = bcsub(
            (string)$totalPaymentTopUpSum,
            (string)abs((float)$totalPaymentWithdrawSum),
            8
        );

        return view('admin.statistic.finance', [
            'statistics' => $statistics,
            'totalUserBalance' => User::where('balance', '>', '0')->sum('balance'),
            'totalPaymentTopUpSum' => $totalPaymentTopUpSum,
            'totalPaymentWithdrawSum' => $totalPaymentWithdrawSum,
            'balanceDifference' => $balanceDifference,
            'totalCommission' => DB::table('payments')
                ->select(
                    DB::raw('sum(abs(commission_amount)) as value'),
                )
                ->whereNotNull('paid_at')
                ->first(),
            'totalReferralPayments' => Payment::where('status', '=', PaymentStatus::PAID)
                ->where('payment_type_id', '=', PaymentType::whereName('referral_commission')->first()->id)
                ->sum('full_amount'),
        ]);
    }
}
