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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_no')->unique();
            $table->string('vehicle_name');
            $table->string('vehicle_type');
            $table->string('vehicle_image')->nullable(); // Field to store vehicle image path
            $table->string('owner_name');
            $table->string('owner_phn');
            $table->string('driver_name');
            $table->string('driver_phn');
            $table->unsignedBigInteger('stall_no')->nullable(); // Stall ID (if assigned)
            $table->enum('status', ['assigned', 'not_assigned'])->default('not_assigned'); // Status
            $table->timestamps();

            // Foreign key constraint for stall
            $table->foreign('stall_no')->references('id')->on('stalls_lockers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
