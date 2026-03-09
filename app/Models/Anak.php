<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'umur',
    ];

    // 🔗 RELASI ANAK → USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function antropometris()
    {
        return $this->hasMany(Antropometri::class);
    }
    // RELASI ANAK - IMUNISASI
    public function imunisasiAnak()
    {
        return $this->hasMany(ImunisasiAnak::class);
    }
}
