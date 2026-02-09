<?php

// filepath: /c:/xampp/htdocs/furrytails_project/app/Models/Boarding.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Boarding extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'boardings';

    protected $primaryKey = 'boardingID';

    protected $fillable = ['petID', 'boardingType', 'start_date', 'end_date', 'petID', 'status'];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'petID', 'petID');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'serviceID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    // Status constants
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_ACTIVE = 'Active';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_CANCELLED = 'Cancelled';

    // Helper method to get status badge color class
    public function getStatusColorClass()
    {
        return [
            self::STATUS_CONFIRMED => 'tw-bg-blue-100 tw-text-blue-800',
            self::STATUS_ACTIVE => 'tw-bg-green-100 tw-text-green-800',
            self::STATUS_COMPLETED => 'tw-bg-gray-100 tw-text-gray-800',
            self::STATUS_CANCELLED => 'tw-bg-red-100 tw-text-red-800',
        ][$this->status] ?? 'tw-bg-gray-100 tw-text-gray-800';
    }
    
    // Calculate if this booking should be active based on dates
    public function shouldBeActive()
    {
        $today = Carbon::today();
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        
        return $today->between($startDate, $endDate);
    }
    
    // Calculate if this booking should be completed based on dates
    public function shouldBeCompleted()
    {
        $today = Carbon::today();
        $endDate = Carbon::parse($this->end_date);
        
        return $today->isAfter($endDate);
    }
}