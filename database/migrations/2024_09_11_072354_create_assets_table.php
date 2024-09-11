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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys for different types of rooms/stalls
            $table->foreignId('resroom_id')->nullable()->constrained('resrooms')->onDelete('cascade');
            $table->foreignId('comroom_id')->nullable()->constrained('comrooms')->onDelete('cascade');
            $table->foreignId('stall_locker_id')->nullable()->constrained('stalls_lockers')->onDelete('cascade');

            $table->string('room_id');       // Room or Stall identifier (e.g., "bedroom1", "stall1")
            $table->json('assets_details');  // JSON column for asset details
            $table->timestamps();

            // Ensure uniqueness across the room or stall types with room_id
            $table->unique(['resroom_id', 'comroom_id', 'stall_locker_id', 'room_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};


