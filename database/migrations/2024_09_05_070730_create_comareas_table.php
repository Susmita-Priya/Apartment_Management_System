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
        Schema::create('comareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained()->onDelete('cascade'); // Each common area is associated with a block
            $table->boolean('firelane')->nullable();
            $table->boolean('building_entrance')->nullable();
            $table->boolean('corridors')->nullable();
            $table->boolean('driveways')->nullable();
            $table->boolean('emergency_stairways')->nullable();
            $table->boolean('garden')->nullable();
            $table->boolean('hallway')->nullable();
            $table->boolean('loading_dock')->nullable();
            $table->boolean('lobby')->nullable();
            $table->boolean('parking_entrance')->nullable();
            $table->boolean('patio')->nullable();
            $table->boolean('rooftop')->nullable();
            $table->boolean('stairways')->nullable();
            $table->boolean('walkways')->nullable();
            $table->timestamps();
        });

        Schema::create('com_extra_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comarea_id')->constrained()->onDelete('cascade');
            $table->string('field_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('com_extra_fields');
        Schema::dropIfExists('comareas');
    }
};
