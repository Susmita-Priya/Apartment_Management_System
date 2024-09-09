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
            $table->foreignId('resroom_id')->constrained()->onDelete('cascade'); // Foreign key to resroom
            $table->string('room_id');       // Room identifier (e.g., "bedroom1", "bathroom1")
            $table->json('assets_details');  // JSON column for asset details
            $table->timestamps();

            $table->unique(['resroom_id', 'room_id']); // Ensure only one row per resroom_id and room_id
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

