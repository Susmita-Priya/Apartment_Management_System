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
        Schema::create('stalls_lockers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('floor_id');
            $table->string('stall_locker_no');
            $table->enum('type', ['Bike Parking Stall', 'Car Parking Stall', 'Storage Locker']);
            $table->integer('capacity')->nullable(); // Add capacity field
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stalls_lockers');
    }
};
