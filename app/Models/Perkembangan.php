<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    protected $fillable = [
        'anak_id',
        'umur_bulan',
        'total_milestone',
        'tercapai',
        'belum',
        'status',
        'edukasi',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
