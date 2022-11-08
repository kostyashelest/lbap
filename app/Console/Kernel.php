<?php

namespace App\Console;

use App\Services\AddressService;
use App\Services\CheckDiffBalanceService;
use App\Services\CommissionService;
use App\Services\PaymentCheckService;
use App\Services\PaymentService;
use App\Services\TransactionCreateService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Check available (free) addresses
        $schedule->call(function () {
            AddressService::isFreeAddressExists();
        })->everyFifteenMinutes();

        // Check diff user balance with user transactions sum
        $schedule->call(function () {
            (new CheckDiffBalanceService())->handle();
        })->everyThirtyMinutes();

        // Check new payment
        $schedule->call(function () {
            $paymentCheckService = $this->app->make(PaymentCheckService::class);
            $paymentCheckService->handle();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
