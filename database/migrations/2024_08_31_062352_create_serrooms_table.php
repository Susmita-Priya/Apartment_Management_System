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
        Schema::create('serrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Each service room is associated with a unit
            $table->integer('garbage_chute')->default(0);
            $table->integer('garbage_recycling_room')->default(0);
            $table->integer('inventory_rooms')->default(0);
            $table->integer('janitorial_room')->default(0);
            $table->integer('laundry_room')->default(0);
            $table->integer('loading_dock')->default(0);
            $table->integer('lobby')->default(0);
            $table->integer('mailroom')->default(0);
            $table->integer('mens_bathroom')->default(0);
            $table->integer('mens_washroom')->default(0);
            $table->integer('shipping_receiving')->default(0);
            $table->integer('storage_room')->default(0);
            $table->integer('womens_bathroom')->default(0);
            $table->integer('womens_washroom')->default(0);
            $table->integer('workshop')->default(0);
            $table->timestamps();
        });

        Schema::create('ser_extra_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serroom_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('ser_extra_rooms');
        Schema::dropIfExists('serrooms');
    }
};
