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
        Schema::create('comrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Each room is associated with a unit
            $table->integer('bathroom')->default(0);
            $table->integer('office_room')->default(0);
            $table->integer('conference_room')->default(0);
            $table->integer('dining_room')->default(0);
            $table->integer('kitchen')->default(0);
            $table->integer('laundry')->default(0);
            $table->integer('solarium')->default(0);
            $table->integer('storage')->default(0);
            $table->integer('washroom')->default(0);
            $table->timestamps();
        });

        Schema::create('com_extra_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comroom_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('com_extra_rooms');
        Schema::dropIfExists('comrooms');
    }
};
