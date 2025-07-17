<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motivation',
        // ajoute d'autres champs si nécessaire
    ];
}
