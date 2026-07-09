<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('story');
            $table->string('google_drive_link')->nullable();
            $table->string('google_drive_preview')->nullable();
            $table->string('google_drive_thumbnail')->nullable();
            $table->enum('category', ['smartphone', 'dslr']);
            $table->string('location')->nullable();
            $table->date('taken_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'disqualified'])->default('pending');
            $table->boolean('is_disqualified')->default(false);
            $table->string('sync_id')->unique()->comment('Google Sheets Row ID or custom unique identifier');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
