<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('periods', function (Blueprint $table) {
    $table->id();
    $table->date('start')->nullable();
    $table->date('end')->nullable();
    $table->integer('rooms_available')->default(0); // عدد الغرف المتاحة في هذه الفترة
    $table->decimal('period_price', 10, 2)->default(0); // سعر الغرفة لهذه الفترة
    $table->unsignedBigInteger('price_id')->nullable();
    $table->foreign('price_id')->references('id')->on('prices')->onDelete('CASCADE');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
