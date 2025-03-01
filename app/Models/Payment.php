<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $primaryKey = 'paymentID';

    protected $fillable = [
        'amount',
        'timestamp',
        'payment_method',
        'status',
        'payable_id',
        'payable_type',
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}