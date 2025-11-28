<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            // Tambah kolom hanya jika belum ada
            if (!Schema::hasColumn('kunjungan', 'instansi')) {
                $table->string('instansi')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('kunjungan', 'keperluan')) {
                $table->string('keperluan')->nullable()->after('instansi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            if (Schema::hasColumn('kunjungan', 'instansi')) {
                $table->dropColumn('instansi');
            }
            if (Schema::hasColumn('kunjungan', 'keperluan')) {
                $table->dropColumn('keperluan');
            }
        });
    }
};
