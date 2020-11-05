<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenetapanNiaga extends Model
{
    //
    protected $table = 'penetapan_niaga';

    protected $fillable = ['id_penetapan_niaga','penetapan_niaga_tanggal','niaga_id','penetapan_niaga_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
