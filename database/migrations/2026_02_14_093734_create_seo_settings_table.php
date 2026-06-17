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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            // Basic SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('canonical_url')->nullable();

            // Open Graph (Facebook)
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_type')->default('website');
            $table->string('og_site_name')->nullable();
            $table->string('fb_app_id')->nullable();

            // Twitter Card
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_site')->nullable();
            $table->string('twitter_creator')->nullable();
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            // Analytics & Verification
            $table->string('google_analytics_id')->nullable();
            $table->string('google_site_verification')->nullable();
            $table->string('facebook_pixel_id')->nullable();

            // Additional Settings
            $table->text('custom_head_code')->nullable();
            $table->text('custom_body_code')->nullable();
            $table->boolean('index_page')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
