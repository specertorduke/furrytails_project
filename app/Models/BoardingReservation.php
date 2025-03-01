<?php

// filepath: /c:/xampp/htdocs/dashboard/furrytails_project/app/Models/BoardingReservation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingReservation extends Model
{
    use HasFactory;

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