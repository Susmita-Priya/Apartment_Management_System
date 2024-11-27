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
            $table->foreignId('company_id')->references('id')->on('users');
            $table->foreignId('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->string('floor_no');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_residential_unit_exist')->nullable();
            $table->boolean('is_commercial_unit_exist')->nullable();
            $table->boolean('is_supporting_room_exist')->nullable();
            $table->boolean('is_parking_lot_exist')->nullable();
            $table->boolean('is_storage_lot_exist')->nullable();
            $table->string('status');
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
