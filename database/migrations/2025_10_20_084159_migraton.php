<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // If you don't have doctrine/dbal, use direct SQL to ALTER
        DB::statement("ALTER TABLE `kunjungan` MODIFY `metode` TINYINT UNSIGNED NOT NULL DEFAULT 2");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // revert back to original enum values (adjust if your original enum differs)
        DB::statement("ALTER TABLE `kunjungan` MODIFY `metode` ENUM('RFID','QR','Manual') NOT NULL DEFAULT 'Manual'");
    }
};
