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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained()->onDelete('cascade');
            $table->string('floor_no');
            $table->string('name')->nullable();
            $table->enum('type', ['rooftop', 'upper', 'ground', 'underground']);
            $table->boolean('residential_suite')->nullable();
            $table->boolean('commercial_unit')->nullable();
            $table->boolean('supporting_service_room')->nullable();
            $table->boolean('parking_lot')->nullable();
            $table->boolean('bike_lot')->nullable();
            $table->boolean('storage_lot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};
