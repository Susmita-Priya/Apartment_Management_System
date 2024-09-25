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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stall_no');
            $table->json('vehicle_no'); // Change to JSON to store multiple vehicle IDs
            $table->unsignedBigInteger('parker_no');
            $table->timestamps();

            $table->foreign('stall_no')->references('id')->on('stalls_lockers')->onDelete('cascade');
            $table->foreign('parker_no')->references('id')->on('parkers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
