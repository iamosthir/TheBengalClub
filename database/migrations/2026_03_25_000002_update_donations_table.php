<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->foreignId('donation_category_id')->nullable()->after('id')
                  ->constrained('donation_categories')->nullOnDelete();
        });

        // Expand enum to allow all old + new values, migrate data, then narrow
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending','approved','rejected','verified','canceled') NOT NULL DEFAULT 'pending'");
        DB::statement("UPDATE donations SET status = 'verified' WHERE status = 'approved'");
        DB::statement("UPDATE donations SET status = 'canceled' WHERE status = 'rejected'");
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending','verified','canceled') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Reverse status migration
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending','approved','rejected','verified','canceled') NOT NULL DEFAULT 'pending'");
        DB::statement("UPDATE donations SET status = 'approved' WHERE status = 'verified'");
        DB::statement("UPDATE donations SET status = 'rejected' WHERE status = 'canceled'");
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending'");

        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['donation_category_id']);
            $table->dropColumn('donation_category_id');
        });
    }
};
