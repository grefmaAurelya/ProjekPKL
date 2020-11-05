<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niaga extends Model
{
    //
    protected $fillable = ['nama_material_niaga','satuan_niaga', 'harga_satuan_niaga','transportasi_dan_asuransi_niaga','jenis_material_niaga'];
}
