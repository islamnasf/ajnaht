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
        Schema::create('reser_details', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->integer('count')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->foreign('reservation_id')
                ->references('id')
                ->on('reservations')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reser_details');
    }
};
