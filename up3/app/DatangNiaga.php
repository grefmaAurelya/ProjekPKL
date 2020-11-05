<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatangNiaga extends Model
{
    //
    protected $table = 'datang_niaga';

    protected $fillable = ['id_datang_niaga','datang_niaga_tanggal','niaga_id','datang_niaga_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
