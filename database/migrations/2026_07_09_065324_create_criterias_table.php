<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['all', 'smartphone', 'dslr'])->default('all');
            $table->integer('weight')->default(0)->comment('Percentage weight, e.g., 30 for 30%');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
