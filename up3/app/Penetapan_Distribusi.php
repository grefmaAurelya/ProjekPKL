<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penetapan_Distribusi extends Model
{

    protected $table = 'penetapan_dist';
    protected $fillable = ['tanggal_penetapan_dist','distribusi_id','prk_id','total_penetapan_dist'];
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
