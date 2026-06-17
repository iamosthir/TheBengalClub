<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tan_samitis', function (Blueprint $table) {
            // When set, the plan is a private, user-created investment plan
            // visible and joinable only by this user.
            $table->foreignId('created_by_user_id')
                ->nullable()
                ->after('created_by_admin_id')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tan_samitis', function (Blueprint $table) {
            $table->dropForeign(['created_by_user_id']);
            $table->dropColumn('created_by_user_id');
        });
    }
};
