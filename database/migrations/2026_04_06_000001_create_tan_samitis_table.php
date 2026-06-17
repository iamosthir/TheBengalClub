<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tan_samitis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('monthly_amount', 10, 2);
            $table->unsignedInteger('total_cycles');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('created_by_admin_id')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tan_samitis');
    }
};
