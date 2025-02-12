<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'paymentID';

    protected $fillable = [
        'amount',
        'timestamp',
        'method',
        'status',
        'payable_id',
        'payable_type',
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}