<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RestoreDatabaseCommand extends Command
{
    protected $signature = 'db:restore {--time=} {--confirm}';
    protected $description = 'Restore database to a specific point in time';

    public function handle()
    {
        if (!$this->option('time')) {
            $this->showRecentLogPoints();
            return;
        }

        try {
            $timestamp = Carbon::parse($this->option('time'));
        } catch (\Exception $e) {
            $this->error("Invalid time format. Use YYYY-MM-DD HH:MM:SS");
            return 1;
        }

        if (!$this->option('confirm') && !$this->confirm("Are you sure you want to restore to {$timestamp}? This cannot be undone!")) {
            $this->info('Restoration cancelled.');
            return;
        }

        $this->info("Starting database restoration to: {$timestamp}");
        
        // Start transaction
        DB::beginTransaction();
        
        try {
            // Get all logs after the timestamp, newest first
            $logs = ActivityLog::where('created_at', '>', $timestamp)
                ->orderBy('created_at', 'desc')
                ->get();
            
            $this->info("Found {$logs->count()} changes to revert.");
            $bar = $this->output->createProgressBar($logs->count());
            
            $stats = ['restored' => 0, 'skipped' => 0, 'failed' => 0];
            
            foreach ($logs as $log) {
                $result = $this->revertChange($log);
                $stats[$result]++;
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine(2);
            
            // Commit transaction
            DB::commit();
            
            $this->info("Database restored successfully!");
            $this->table(['Restored', 'Skipped', 'Failed'], [[$stats['restored'], $stats['skipped'], $stats['failed']]]);
            
            return 0;
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Restoration failed: {$e->getMessage()}");
            return 1;
        }
    }
    
    protected function revertChange(ActivityLog $log)
    {
        try {
            $table = $log->table_name;
            $id = $log->record_id;
            $primaryKey = $this->getPrimaryKeyForTable($table);
            
            switch ($log->action) {
                case 'create':
                    // To revert a creation, delete the record
                    DB::table($table)->where($primaryKey, $id)->delete();
                    return 'restored';
                    
                case 'update':
                    // To revert an update, restore old values
                    if ($log->old_values) {
                        $oldValues = $log->old_values;
                        
                        // Remove timestamps from update
                        unset($oldValues['updated_at']);
                        unset($oldValues['created_at']);
                        
                        DB::table($table)->where($primaryKey, $id)->update($oldValues);
                        return 'restored';
                    }
                    return 'skipped';
                    
                case 'delete':
                    // To revert a deletion, recreate the record
                    if ($log->old_values) {
                        DB::table($table)->insert($log->old_values);
                        return 'restored';
                    }
                    return 'skipped';
                    
                default:
                    return 'skipped';
            }
        } catch (\Exception $e) {
            $this->warn("Failed to process log #{$log->logID}: {$e->getMessage()}");
            return 'failed';
        }
    }
    
    protected function getPrimaryKeyForTable($table)
    {
        $tableMap = [
            'users' => 'userID',
            'employees' => 'employeeID',
            'pets' => 'petID',
            'services' => 'serviceID',
            'appointments' => 'appointmentID',
            'boardings' => 'boardingID',
            'payments' => 'paymentID',
            'activity_logs' => 'logID',
            // Add more tables as needed
        ];
        
        return $tableMap[$table] ?? 'id';
    }
    
    protected function showRecentLogPoints()
    {
        $timestamps = ActivityLog::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as hour'))
            ->distinct()
            ->orderBy('hour', 'desc')
            ->limit(24)
            ->pluck('hour');
            
        $this->info("Recent timepoints for restoration:");
        foreach ($timestamps as $time) {
            $this->line(" - $time");
        }
        $this->info("\nRun command with --time option to restore to a specific time.");
        $this->line("Example: php artisan db:restore --time=\"2025-03-01 14:00:00\" --confirm");
    }
}