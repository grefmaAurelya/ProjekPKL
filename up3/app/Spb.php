<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    //
    protected $table = 'spb';
    
    protected $fillable = ['no_spb_mstr'];

    protected $hidden = ['created_at','updated_at'];
}
