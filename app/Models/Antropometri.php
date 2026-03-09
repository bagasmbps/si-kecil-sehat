<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antropometri extends Model
{
    protected $fillable = [
        'anak_id',
        'umur_bulan',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
