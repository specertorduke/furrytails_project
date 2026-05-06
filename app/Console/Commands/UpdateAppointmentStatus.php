<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;

class UpdateAppointmentStatus extends Command
{
    protected $signature = 'appointments:update-status';
    protected $description = 'Updates appointment statuses based on date and time';

    public function handle()
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');
        
        // 1. Update appointments to "Active" when their time arrives
        $activated = Appointment::whereIn('status', ['Pending', 'Confirmed'])
            ->where('date', $today)
            ->where('time', '<=', $currentTime)
            ->update(['status' => 'Active']);
            
        // 2. End of day process: Mark any active appointments as "Completed"
        // Only do this after business hours (e.g., after 7 PM)
        if ($now->hour >= 19) {
            $completed = Appointment::where('status', 'Active')
                ->where('date', $today)
                ->update(['status' => 'Completed']);
        } else {
            $completed = 0;
        }
        
        // 3. Mark past pending appointments as "Missed"
        $missed = Appointment::where('status', 'Pending')
            ->where('date', '<', $today)
            ->update(['status' => 'Missed']);
            
        // 4. Mark past confirmed or active appointments as "Completed"
        $completedPast = Appointment::whereIn('status', ['Confirmed', 'Active'])
            ->where('date', '<', $today)
            ->update(['status' => 'Completed']);
            
        $totalCompleted = $completed + $completedPast;
            
        $this->info("Updated {$activated} to Active, {$totalCompleted} to Completed, {$missed} to Missed");
        
        return Command::SUCCESS;
    }
}