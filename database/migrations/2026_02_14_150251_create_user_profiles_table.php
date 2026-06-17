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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('membership_application_id')->nullable()->constrained('membership_applications')->onDelete('set null');
            $table->date('date_of_birth');
            $table->string('nid_passport');
            $table->string('profession_organization');
            $table->string('mobile', 20);
            $table->text('address');
            $table->foreignId('membership_category_id')->constrained('membership_categories')->onDelete('cascade');
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('membership_application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
