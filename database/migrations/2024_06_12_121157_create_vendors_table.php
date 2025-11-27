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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();
            $table->string('wattsapp')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable(); 
            $table->foreign('Sub_category_id')->references('id')->on('sub_categories')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
