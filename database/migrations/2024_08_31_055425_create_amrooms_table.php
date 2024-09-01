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
        Schema::create('amrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Each amenity room is associated with a unit
            $table->integer('balcony')->default(0);
            $table->integer('business_center')->default(0);
            $table->integer('gym')->default(0);
            $table->integer('hot_tub')->default(0);
            $table->integer('laundry_room')->default(0);
            $table->integer('library')->default(0);
            $table->integer('meeting_room')->default(0);
            $table->integer('mens_changing_room')->default(0);
            $table->integer('restaurant')->default(0);
            $table->integer('room_deck')->default(0);
            $table->integer('sauna')->default(0);
            $table->integer('swimming_pool')->default(0);
            $table->integer('theater_room')->default(0);
            $table->integer('womens_changing_room')->default(0);
            $table->integer('patio')->default(0);
            $table->timestamps();
        });

        Schema::create('am_extra_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amroom_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('am_extra_rooms');
        Schema::dropIfExists('amrooms');
    }
};
