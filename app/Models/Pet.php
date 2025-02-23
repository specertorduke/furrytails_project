<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pet extends Model
{
    protected $primaryKey = 'petID';
    
    protected $fillable = [
        'name',
        'species',
        'petType',
        'gender',
        'birthDate',
        'weight',
        'petImage',
        'petNotes',
        'medicalHistory',
        'allergies',
        'isVaccinated',
        'lastVaccinationDate',
        'userID'
    ];

    protected $dates = [
        'birthDate',
        'lastVaccinationDate'
    ];

    public function getAgeAttribute()
    {
        if (!$this->birthDate) {
            return null;
        }

        $birthDate = Carbon::parse($this->birthDate);
        $now = Carbon::now();
        
        $years = floor($birthDate->diffInYears($now));
        $months = floor($birthDate->copy()->addYears($years)->diffInMonths($now));
        
        if ($years > 0) {
            return $years . ($years == 1 ? ' year' : ' years') . 
                ($months > 0 ? ' ' . $months . ($months == 1 ? ' month' : ' months') : '');
        } else {
            $months = $birthDate->diffInMonths($now);
            return $months . ($months == 1 ? ' month' : ' months');
        }
    }
}