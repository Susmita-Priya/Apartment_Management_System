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
            $table->boolean('firelane')->default(false);
            $table->boolean('building_entrance')->default(false);
            $table->boolean('corridors')->default(false);
            $table->boolean('driveways')->default(false);
            $table->boolean('emergency_stairways')->default(false);
            $table->boolean('garden')->default(false);
            $table->boolean('hallway')->default(false);
            $table->boolean('loading_dock')->default(false);
            $table->boolean('lobby')->default(false);
            $table->boolean('parking_entrance')->default(false);
            $table->boolean('patio')->default(false);
            $table->boolean('rooftop')->default(false);
            $table->boolean('stairways')->default(false);
            $table->boolean('walkways')->default(false);
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
