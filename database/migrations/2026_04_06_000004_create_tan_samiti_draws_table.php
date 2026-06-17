<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tan_samiti_draws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tan_samiti_id')->constrained('tan_samitis')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('cycle_number');
            $table->timestamp('drawn_at');
            $table->foreignId('drawn_by_admin_id')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();

            // One winner per cycle per samiti
            $table->unique(['tan_samiti_id', 'cycle_number']);
            // Each member wins only once per samiti
            $table->unique(['tan_samiti_id', 'user_id']);
            $table->index('tan_samiti_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tan_samiti_draws');
    }
};
