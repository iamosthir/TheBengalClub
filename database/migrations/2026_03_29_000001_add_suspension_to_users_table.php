<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('suspended_at')->nullable()->after('remember_token');
            $table->text('suspension_reason')->nullable()->after('suspended_at');
            $table->foreignId('suspended_by_admin_id')->nullable()->constrained('admins')->nullOnDelete()->after('suspension_reason');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['suspended_by_admin_id']);
            $table->dropColumn(['suspended_at', 'suspension_reason', 'suspended_by_admin_id']);
        });
    }
};
