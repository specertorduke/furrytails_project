<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        // Log model creation
        static::created(function ($model) {
            self::logActivity('create', $model);
        });

        // Log model updates
        static::updated(function ($model) {
            self::logActivity('update', $model, $model->getOriginal());
        });

        // Log model deletion
        static::deleted(function ($model) {
            self::logActivity('delete', $model, $model->getAttributes());
        });
    }

    protected static function logActivity($action, $model, $oldValues = null)
    {
        $userID = null;
        
        // Get logged in user ID if available
        if (Auth::check()) {
            $userID = Auth::id();
        }

        // Create the activity log entry
        ActivityLog::create([
            'table_name' => $model->getTable(),
            'record_id' => $model->getKey(),
            'action' => $action,
            'old_values' => $action != 'create' ? $oldValues : null,
            'new_values' => $action != 'delete' ? $model->getAttributes() : null,
            'userID' => $userID,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
        ]);
    }
}