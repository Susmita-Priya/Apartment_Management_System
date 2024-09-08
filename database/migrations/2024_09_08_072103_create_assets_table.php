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
            $table->string('room_id');       // Room identifier (e.g., "bedroom1", "bathroom2")
            $table->string('asset_name');    // Name of the asset (e.g., "Chair", "Table")
            $table->integer('quantity');     // Quantity of the asset
            $table->timestamps();
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
