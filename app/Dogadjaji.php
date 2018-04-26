<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dogadjaji extends Model
{
     protected $fillable = [
        'user_id','naslov', 'text','slika','datum','telefon',
    ];
}
