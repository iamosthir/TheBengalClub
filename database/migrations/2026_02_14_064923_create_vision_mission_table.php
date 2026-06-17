<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vision_mission', function (Blueprint $table) {
            $table->id();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->timestamps();
        });

        // Insert initial record
        DB::table('vision_mission')->insert([
            'id' => 1,
            'vision' => 'To be recognized as one of Bangladesh\'s most prestigious and well-governed premium social clubs.',
            'mission' => 'Provide a high-standard social and business networking platform. Organize exclusive events, discussions, and cultural engagements. Promote professionalism, mutual respect, and community values among members.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vision_mission');
    }
};
