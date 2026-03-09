<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perkembangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained()->cascadeOnDelete();
            $table->integer('umur_bulan');
            $table->integer('total_milestone');
            $table->integer('tercapai');
            $table->integer('belum');
            $table->string('status');
            $table->text('edukasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perkembangans');
    }
};
