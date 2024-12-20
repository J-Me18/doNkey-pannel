<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->call(function () {
        //     DB::table('subscriber')->update(['activestatus' => 0]);
        // })->hourly();

        // Task to run get:access_token_user command every minute
        $schedule->command('get:access_token_user')->everyMinute();

        // Task to run get:access_token_driver command every minute
        $schedule->command('get:access_token_driver')->everyMinute();

        // Task to run get:subscriber_notify command every hour
        $schedule->command('get:subscriber_notify')->everyMinute();
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
