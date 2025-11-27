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
        Schema::create('docs_files', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->unsignedBigInteger('docs_id')->nullable(); 
            $table->foreign('docs_id')->references('id')->on('documents')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs_files');
    }
};
