<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\slikeOglasi;

class Oglasi extends Model
{
      protected $fillable = [
        'user_id','naslov', 'text','kategorija','cena','telefon',
    ];
	
	public function slike()
    {
        return $this->hasMany('App\slikeOglasi'); //make sure your images table has user_id column
    }
}
