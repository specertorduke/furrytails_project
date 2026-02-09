<?php
// filepath: /c:/xampp/htdocs/furrytails_project/app/Models/Appointment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $primaryKey = 'appointmentID';

    protected $fillable = ['date', 'time', 'serviceID', 'petID', 'status'];


    public function pet()
    {
        return $this->belongsTo(Pet::class, 'petID');
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

   /**
     * Get human-readable time remaining until appointment
     */
    public function getTimeUntilAttribute()
    {
        $now = Carbon::now();
        $appointmentTime = Carbon::parse("{$this->date} {$this->time}");
        
        if ($now > $appointmentTime) {
            return 'In progress';
        }
        
        return $now->diffForHumans($appointmentTime, ['parts' => 2]);
    }

    /**
     * Get time period in a friendly format
     */
    public function getTimePeriodAttribute()
    {
        $start = Carbon::parse("{$this->date} {$this->time}");
        // Assume 1-hour appointments
        $end = $start->copy()->addHour();
        
        return $start->format('g:i A') . ' - ' . $end->format('g:i A');
    }
    
    // Add this method for status colors
    public function getStatusColorClass()
    {
        return [
            'Pending' => 'tw-bg-blue-100 tw-text-blue-800',
            'Active' => 'tw-bg-green-100 tw-text-green-800',
            'Completed' => 'tw-bg-gray-100 tw-text-gray-800',
            'Cancelled' => 'tw-bg-red-100 tw-text-red-800',
            'Missed' => 'tw-bg-yellow-100 tw-text-yellow-800',
        ][$this->status] ?? 'tw-bg-gray-100 tw-text-gray-800';
    }
}