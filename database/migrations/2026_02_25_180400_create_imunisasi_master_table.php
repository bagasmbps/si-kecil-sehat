<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('imunisasi_master', function (Blueprint $table) {
            $table->id();
            $table->string('nama_imunisasi');
            $table->integer('umur_bulan'); // target umur (bulan)
            $table->string('kategori'); // primer / lanjutan / booster
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imunisasi_master');
    }
};