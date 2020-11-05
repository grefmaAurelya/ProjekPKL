<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rkap_Distribusi extends Model
{
    //
  
    protected $table = 'rkap_dist';
    protected $fillable = ['tanggal_rkap_dist','distribusi_id','prk_id','total_rkap_dist'];
    protected $hidden = ['created_at','updated_at'];

    public function distribusi()
    {
        return $this->belongsTo (Distribusi::class);
    }

    public function prk()
    {
        return $this->belongsTo (Prk::class);
    }

}
