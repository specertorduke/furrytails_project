<?php
// filepath: /c:/xampp/htdocs/dashboard/furrytails_project/app/Models/Appointment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointmentID';

    protected $fillable = [
        'appointmentID',
        'date',
        'time',
        'serviceID',
        'petID',
        'status',
    ];

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
}