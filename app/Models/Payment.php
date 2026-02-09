<?php
// filepath: /c:/xampp/htdocs/furrytails_project/app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'paymentID';
    
    protected $fillable = [
        'amount', 
        'payment_method', 
        'reference_number',
        'status',
        'payable_type',
        'payable_id',
        'userID'
    ];
    
    /**
     * Get the user that owns this payment
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    /**
     * Get the payable model (polymorphic)
     */
    public function payable()
    {
        return $this->morphTo();
    }
}