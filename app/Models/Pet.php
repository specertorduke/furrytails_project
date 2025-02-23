<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $primaryKey = 'petID';

    protected $fillable = ['name', 'species', 'petType', 'petImage', 'petNotes', 'age', 'userID'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}

