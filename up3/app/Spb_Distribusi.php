<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spb_Distribusi extends Model
{

    protected $table = 'spb_dist';
    protected $fillable = ['tanggal_spb_dist','distribusi_id','prk_id','spb_id','pabrikan_id','total_spb_dist'];
    protected $hidden = ['created_at','updated_at'];

    public function distribusi()
    {
        return $this->belongsTo (Distribusi::class);
    }

    public function spb()
    {
        return $this->belongsTo (Spb::class);
    }

    public function prk()
    {
        return $this->belongsTo (Prk::class);
    }

    public function pabrikan()
    {
        return $this->belongsTo (Pabrikan::class);
    }

}
