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
       Schema::create('reservations', function (Blueprint $table) {
    $table->id();

    $table->string('type')->nullable();

    $table->string('client')->nullable();
    $table->string('status')->nullable();
    $table->string('guest')->nullable();
    $table->string('nationality')->nullable();
    $table->string('phone')->nullable();

    $table->date('start')->nullable();
    $table->date('end')->nullable();

    $table->integer('rooms')->nullable();

    $table->decimal('price', 10, 2)->nullable();
    $table->decimal('total', 10, 2)->nullable();

    $table->unsignedBigInteger('hotel_id')->nullable();
    $table->foreign('hotel_id')
        ->references('id')
        ->on('categories')
        ->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
