<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('perkembangans', function (Blueprint $table) {

            if (!Schema::hasColumn('perkembangans', 'umur_bulan')) {
                $table->integer('umur_bulan')->after('anak_id');
            }

            if (!Schema::hasColumn('perkembangans', 'total_milestone')) {
                $table->integer('total_milestone')->default(0);
            }

            if (!Schema::hasColumn('perkembangans', 'tercapai')) {
                $table->integer('tercapai')->default(0);
            }

            if (!Schema::hasColumn('perkembangans', 'belum')) {
                $table->integer('belum')->default(0);
            }

            if (!Schema::hasColumn('perkembangans', 'status')) {
                $table->string('status')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('perkembangans', function (Blueprint $table) {
            $table->dropColumn([
                'umur_bulan',
                'total_milestone',
                'tercapai',
                'belum',
                'status'
            ]);
        });
    }
};
