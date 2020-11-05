<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rkap_Niaga extends Model
{
    //
  
    protected $table = 'rkap_niaga';
    protected $fillable = ['tanggal_rkap_niaga','niaga_id','prk_id','total_rkap_niaga'];
    protected $hidden = ['created_at','updated_at'];

    public function niaga()
    {
        return $this->belongsTo (Niaga::class);
    }

    public function prk()
    {
        return $this->belongsTo (Prk::class);
    }

}
