<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImunisasiMasterSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['HB-0', 0, 'primer'],
            ['BCG', 1, 'primer'],
            ['Polio 1', 2, 'primer'],
            ['DPT-HB-Hib 1', 2, 'primer'],
            ['Polio 2', 3, 'primer'],
            ['DPT-HB-Hib 2', 3, 'primer'],
            ['Polio 3', 4, 'primer'],
            ['DPT-HB-Hib 3', 4, 'primer'],
            ['Polio 4', 4, 'primer'],
            ['Campak / MR', 9, 'primer'],
            ['DPT-HB-Hib Lanjutan', 18, 'lanjutan'],
            ['Campak Lanjutan', 18, 'lanjutan'],
            ['DT Booster', 60, 'booster'],
            ['Td Booster', 72, 'booster'],
        ];

        foreach ($data as $i) {
            DB::table('imunisasi_master')->insert([
                'nama_imunisasi' => $i[0],
                'umur_bulan' => $i[1],
                'kategori' => $i[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}