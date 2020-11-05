<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerkontrakDist extends Model
{
    //
    protected $table = 'terkontrak_distribusi';

    protected $fillable = ['id_terkontrak_distribusi','terkontrak_dist_tanggal','distribusi_id','terkontrak_dist_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
