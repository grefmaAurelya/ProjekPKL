<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpbDist extends Model
{
    //
    protected $table = 'spb_distribusi';

    protected $fillable = ['id_spb_distribusi','spb_dist_tanggal','distribusi_id','spb_dist_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
