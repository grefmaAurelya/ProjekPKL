<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkapNiaga extends Model
{
    //
    protected $table = 'rkap_niaga';

    protected $fillable = ['id_rkap_niaga','rkap_niaga_tanggal','niaga_id','rkap_niaga_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
