<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pabrikan extends Model
{
    //
    protected $table = 'pabrikan';
   
    protected $fillable = ['pabrikan_mstr'];

    protected $hidden = ['created_at','updated_at'];

}
