<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tan_samitis', function (Blueprint $table) {
            $table->boolean('enable_lottery_draw')->default(true)->after('total_cycles');
            $table->unsignedInteger('member_limit')->nullable()->after('enable_lottery_draw');
            $table->date('start_date')->nullable()->after('member_limit');
        });
    }

    public function down(): void
    {
        Schema::table('tan_samitis', function (Blueprint $table) {
            $table->dropColumn(['enable_lottery_draw', 'member_limit', 'start_date']);
        });
    }
};
