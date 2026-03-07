<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\LogsActivity;
use App\Models\Appointment;

class Service extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $primaryKey = 'serviceID';

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'serviceImage',
        'isActive',
    ];

    protected $casts = [
        'price' => 'float',
        'isActive' => 'boolean',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'serviceID', 'serviceID');
    }
}