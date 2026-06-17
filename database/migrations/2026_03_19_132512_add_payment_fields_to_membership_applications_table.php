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
        Schema::table('membership_applications', function (Blueprint $table) {
            $table->foreignId('payment_method_id')->nullable()->after('membership_category_id')->constrained('payment_methods')->nullOnDelete();
            $table->string('transaction_id')->nullable()->after('payment_method_id');
            $table->string('payment_proof_path')->nullable()->after('transaction_id');
            $table->timestamp('payment_verified_at')->nullable()->after('payment_proof_path');
            $table->foreignId('payment_verified_by_admin_id')->nullable()->after('payment_verified_at')->constrained('admins')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_applications', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['payment_verified_by_admin_id']);
            $table->dropColumn(['payment_method_id', 'transaction_id', 'payment_proof_path', 'payment_verified_at', 'payment_verified_by_admin_id']);
        });
    }
};
