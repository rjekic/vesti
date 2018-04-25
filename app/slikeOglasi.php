<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slikeOglasi extends Model
{
     protected $fillable = [
        'user_id','oglasi_id','slika','tip',
    ];
}
