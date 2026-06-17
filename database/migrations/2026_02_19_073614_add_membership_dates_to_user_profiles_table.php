<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dateTime('membership_start_at')->nullable()->after('membership_category_id');
            $table->dateTime('membership_end_at')->nullable()->after('membership_start_at');
        });
    }

    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['membership_start_at', 'membership_end_at']);
        });
    }
};
