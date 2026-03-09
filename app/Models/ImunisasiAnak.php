<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImunisasiAnak extends Model
{
    protected $table = 'imunisasi_anaks';

    protected $fillable = [
        'anak_id',
        'imunisasi_master_id',
        'status',
        'tanggal',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
    
    public function imunisasiMaster()
    {
        return $this->belongsTo(ImunisasiMaster::class,'imunisasi_master_id');
    }
}