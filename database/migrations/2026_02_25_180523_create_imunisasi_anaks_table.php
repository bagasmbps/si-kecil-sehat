<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('imunisasi_anaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained()->cascadeOnDelete();
            $table->foreignId('imunisasi_master_id')->constrained('imunisasi_master')->cascadeOnDelete();
            $table->date('tanggal_diberikan')->nullable();
            $table->enum('status', ['belum', 'sudah', 'terlewat'])->default('belum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imunisasi_anaks');
    }
};