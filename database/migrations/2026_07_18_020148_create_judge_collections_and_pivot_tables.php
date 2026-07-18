<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('judge_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judge_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
            
            $table->unique(['judge_id', 'name']);
        });

        Schema::create('judge_collection_photo', function (Blueprint $table) {
            $table->foreignId('judge_collection_id')->constrained('judge_collections')->onDelete('cascade');
            $table->foreignId('photo_id')->constrained('photos')->onDelete('cascade');
            
            $table->primary(['judge_collection_id', 'photo_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('judge_collection_photo');
        Schema::dropIfExists('judge_collections');
    }
};
