<?php

// filepath: /c:/xampp/htdocs/dashboard/furrytails_project/app/Models/BoardingReservation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingReservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservationID';

    protected $fillable = [
        'boardingType',
        'startDate',
        'endDate',
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
}