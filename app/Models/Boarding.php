<?php

// filepath: /c:/xampp/htdocs/dashboard/furrytails_project/app/Models/Boarding.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;

class Boarding extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'boarding_reservations';

    protected $primaryKey = 'boardingID';

    protected $fillable = ['boardingType', 'start_date', 'end_date', 'petID', 'status'];

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