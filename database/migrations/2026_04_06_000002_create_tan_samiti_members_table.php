<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tan_samiti_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tan_samiti_id')->constrained('tan_samitis')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['tan_samiti_id', 'user_id']);
            $table->index(['tan_samiti_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tan_samiti_members');
    }
};
