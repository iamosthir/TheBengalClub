<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Widen the column to text so it can hold JSON
        Schema::table('honorary_members', function (Blueprint $table) {
            $table->text('designation')->nullable()->change();
        });

        // Convert any plain-string values to a single-element JSON array
        DB::table('honorary_members')
            ->whereNotNull('designation')
            ->get()
            ->each(function ($row) {
                $decoded = json_decode($row->designation, true);
                if (!is_array($decoded)) {
                    DB::table('honorary_members')
                        ->where('id', $row->id)
                        ->update(['designation' => json_encode([$row->designation])]);
                }
            });
    }

    public function down(): void
    {
        // Convert back: flatten the first element of each array to a plain string
        DB::table('honorary_members')
            ->whereNotNull('designation')
            ->get()
            ->each(function ($row) {
                $decoded = json_decode($row->designation, true);
                if (is_array($decoded)) {
                    DB::table('honorary_members')
                        ->where('id', $row->id)
                        ->update(['designation' => $decoded[0] ?? null]);
                }
            });

        Schema::table('honorary_members', function (Blueprint $table) {
            $table->string('designation')->nullable()->change();
        });
    }
};
