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
        Schema::table('photos', function (Blueprint $table) {
            $table->text('google_drive_link')->nullable()->change();
            $table->text('google_drive_preview')->nullable()->change();
            $table->text('google_drive_thumbnail')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->string('google_drive_link', 255)->nullable()->change();
            $table->string('google_drive_preview', 255)->nullable()->change();
            $table->string('google_drive_thumbnail', 255)->nullable()->change();
        });
    }
};
