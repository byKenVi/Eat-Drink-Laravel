<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Commande extends Model
{
     use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'stand_id',
        'utilisateur_id',
        'details_commande',
        'date_commande',
    ];

    protected $casts = [
        'date_commande' => 'datetime', 
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class, 'stand_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

}
