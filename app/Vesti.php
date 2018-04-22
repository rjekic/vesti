<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vesti extends Model
{
     protected $fillable = [
        'link', 'slika', 'naslov','text','datum','izvor','privilegija',
    ];
}
