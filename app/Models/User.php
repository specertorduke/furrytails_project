<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $primaryKey = 'userID';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'username',
        'phone',
        'password',
        'userImage',
        'google_id',
        'avatar',
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
            Boarding::class,
            Pet::class,
            'userID', // Foreign key on pets table
            'petID',  // Foreign key on boardings table
            'userID', // Local key on users table
            'petID'   // Local key on pets table
        );
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getProfileImageUrlAttribute(): string
    {
        $imagePath = $this->userImage;

        if (!empty($imagePath) && filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        if (!empty($imagePath)) {
            return asset('storage/' . ltrim(preg_replace('/^storage\//i', '', $imagePath), '/'));
        }

        if (!empty($this->avatar) && filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        return asset('storage/userImages/default.png');
    }
}