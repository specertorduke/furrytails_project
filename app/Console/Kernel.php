<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Run the status update command daily at midnight
        $schedule->command('boarding:update-status')->dailyAt('00:01');

        // Run every 15 minutes during business hours (8 AM to 7 PM)
        $schedule->command('appointments:update-status')
                 ->weekdays()
                 ->everyFifteenMinutes()
                 ->between('8:00', '19:00');
                 
        // Run once at the end of day to finalize everything
        $schedule->command('appointments:update-status')
                 ->weekdays()
                 ->dailyAt('19:30');
                 
        // Run once early morning to catch missed appointments
        $schedule->command('appointments:update-status')
                 ->weekdays()
                 ->dailyAt('7:00');
    }
    
    // ...rest of the file...
}