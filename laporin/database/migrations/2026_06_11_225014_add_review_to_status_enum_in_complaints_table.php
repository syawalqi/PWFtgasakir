<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('pending', 'proses', 'review', 'selesai', 'ditolak') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('pending', 'proses', 'selesai', 'ditolak') NOT NULL DEFAULT 'pending'");
    }
};