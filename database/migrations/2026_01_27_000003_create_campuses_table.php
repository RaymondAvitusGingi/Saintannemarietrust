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
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('level');
            $table->string('motto')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('ranking')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('acreage')->nullable();
            $table->string('registration')->nullable();
            $table->string('phone')->nullable();
            
            // Details fields (flattened)
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('headmaster')->nullable();
            $table->text('combinations')->nullable();
            $table->text('history')->nullable();
            $table->text('environment')->nullable();
            $table->json('rules')->nullable();
            $table->json('routine')->nullable();
            
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campuses');
    }
};
