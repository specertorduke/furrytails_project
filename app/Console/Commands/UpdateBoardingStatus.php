<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Boarding;
use Carbon\Carbon;

class UpdateBoardingStatus extends Command
{
    protected $signature = 'boarding:update-status';
    protected $description = 'Updates boarding statuses based on dates';

    public function handle()
    {
        $today = Carbon::today()->toDateString();
        
        // Update "Confirmed" to "Active" when start date equals today
        $activatedCount = Boarding::where('status', 'Confirmed')
            ->where('start_date', '<=', $today)
            ->update(['status' => 'Active']);
            
        // Update "Active" to "Completed" when end date has passed
        $completedCount = Boarding::where('status', 'Active')
            ->where('end_date', '<', $today)
            ->update(['status' => 'Completed']);
            
        $this->info("Updated {$activatedCount} bookings to Active and {$completedCount} bookings to Completed");
        
        return Command::SUCCESS;
    }
}