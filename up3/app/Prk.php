<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prk extends Model
{
    protected $table = 'prk';
    protected $fillable = ['noPrk'];
    protected $hidden = ['created_at','updated_at'];

   
}
