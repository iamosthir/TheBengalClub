<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tan_samiti_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tan_samiti_id')->constrained('tan_samitis')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('cycle_number');
            $table->date('due_date');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->foreignId('member_payment_method_id')
                ->nullable()
                ->constrained('payment_methods')
                ->nullOnDelete();
            $table->string('member_txn_id')->nullable();
            $table->string('member_proof_path')->nullable();
            $table->timestamp('member_submitted_at')->nullable();
            $table->foreignId('completed_by_admin_id')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();
            $table->timestamp('paid_at')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['tan_samiti_id', 'cycle_number']);
            $table->index(['user_id', 'status']);
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tan_samiti_installments');
    }
};
