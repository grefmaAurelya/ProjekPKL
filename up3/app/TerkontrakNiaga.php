<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerkontrakNiaga extends Model
{
    //
    protected $table = 'terkontrak_niaga';

    protected $fillable = ['id_terkontrak_niaga','terkontrak_niaga_tanggal','niaga_id','terkontrak_niaga_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
