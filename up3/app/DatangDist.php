<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatangDist extends Model
{
    //
    protected $table = 'datang_distribusi';

    protected $fillable = ['id_datang_distribusi','datang_dist_tanggal','distribusi_id','datang_dist_total'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

}
