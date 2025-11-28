<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // requires composer require doctrine/dbal
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->enum('metode', ['RFID', 'QR', 'Manual'])->change();
            $table->boolean('is_history')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->string('metode')->change();
            $table->tinyInteger('is_history')->default(0)->change();
        });
    }
};
