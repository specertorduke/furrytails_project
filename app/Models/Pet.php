<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $primaryKey = 'petID';

    protected $fillable = [
        'name',
        'species',
        'breed',
        'petImage',
        'petNotes',
        'age',
        'userID',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}

