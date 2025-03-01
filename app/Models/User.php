<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'userID';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'username',
        'phone',
        'password',
        'userImage',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class, 'userID');
    }

    public function appointments()
    {
        return $this->hasManyThrough(
            Appointment::class,
            Pet::class,
            'userID', // Foreign key on pets table
            'petID',  // Foreign key on appointments table
            'userID', // Local key on users table
            'petID'   // Local key on pets table
        );
    }

    public function boardingReservations()
    {
        return $this->hasManyThrough(
            BoardingReservation::class,
            Pet::class,
            'userID', // Foreign key on pets table
            'petID',  // Foreign key on boarding_reservations table
            'userID', // Local key on users table
            'petID'   // Local key on pets table
        );
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}