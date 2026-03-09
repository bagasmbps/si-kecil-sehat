<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImunisasiMaster extends Model
{
    protected $table = 'imunisasi_master';
    protected $fillable = [
        'nama_imunisasi',
        'umur_bulan',
        'kategori',
    ];
}
