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
        Schema::table('membership_installments', function (Blueprint $table) {
            $table->foreignId('member_payment_method_id')->nullable()->after('completed_by_admin_id')->constrained('payment_methods')->nullOnDelete();
            $table->string('member_txn_id')->nullable()->after('member_payment_method_id');
            $table->string('member_proof_path')->nullable()->after('member_txn_id');
            $table->timestamp('member_submitted_at')->nullable()->after('member_proof_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_installments', function (Blueprint $table) {
            $table->dropForeign(['member_payment_method_id']);
            $table->dropColumn(['member_payment_method_id', 'member_txn_id', 'member_proof_path', 'member_submitted_at']);
        });
    }
};
