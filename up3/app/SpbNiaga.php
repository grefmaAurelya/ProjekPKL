<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpbNiaga extends Model
{
    //
    protected $table = 'spb_niaga';

    protected $fillable = ['id_spb_niaga','spb_niaga_tanggal','niagaribusi_id','spb_niaga_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
