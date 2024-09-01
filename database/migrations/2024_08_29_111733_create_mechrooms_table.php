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
        Schema::create('mechrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Each mechanical room is associated with a unit
            $table->integer('backup_generator')->default(0);
            $table->integer('boilers_room')->default(0);
            $table->integer('compactor_room')->default(0);
            $table->integer('electrical_room')->default(0);
            $table->integer('elevator_mechanical_room')->default(0);
            $table->integer('elevators_pit_room')->default(0);
            $table->integer('elevators_room')->default(0);
            $table->integer('emergency_hydro_room')->default(0);
            $table->integer('fan_room')->default(0);
            $table->integer('fire_extinguishers')->default(0);
            $table->integer('fire_panel')->default(0);
            $table->integer('garbage_chute')->default(0);
            $table->integer('hvac_mechanical_room')->default(0);
            $table->integer('hydro_room')->default(0);
            $table->integer('mechanical_room')->default(0);
            $table->integer('phone_cable_room')->default(0);
            $table->integer('recycling_room')->default(0);
            $table->integer('sprinklers_room')->default(0);
            $table->integer('swimming_pool_mechanical_room')->default(0);
            $table->integer('water_pump_room')->default(0);
            $table->timestamps();
        });

        Schema::create('mech_extra_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mechroom_id')->constrained()->onDelete('cascade');
            $table->string('room_name');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mech_extra_rooms');
        Schema::dropIfExists('mechrooms');
    }
};
