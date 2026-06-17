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
        Schema::create('membership_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('nid_passport');
            $table->string('profession_organization');
            $table->string('mobile', 20);
            $table->string('email');
            $table->text('address');
            $table->foreignId('membership_category_id')
                  ->constrained('membership_categories')
                  ->onDelete('cascade');
            $table->boolean('is_tos_accepted')->default(false);
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                  ->default('pending');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            // Performance indexes
            $table->index('status');
            $table->index(['email', 'status']);
            $table->index(['mobile', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_applications');
    }
};
