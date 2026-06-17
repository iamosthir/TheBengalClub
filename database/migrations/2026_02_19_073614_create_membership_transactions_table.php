<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('membership_installment_id')
                ->nullable()
                ->constrained('membership_installments')
                ->nullOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('payment_type');
            $table->string('trx_id')->nullable();
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();
            $table->enum('completed_by', ['admin', 'user']);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('completed_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_transactions');
    }
};
