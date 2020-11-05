<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{

    protected $table = 'distribusi';
    protected $fillable = ['nama_material_distribusi','satuan_distribusi','jenis_material_distribusi','harga_satuan_dist','asuransi_dan_transportasi_dist'];

  


}
