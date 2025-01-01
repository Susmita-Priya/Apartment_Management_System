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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('id')->on('users');
            $table->foreignId('stall_id')->nullable()->references('id')->on('stalls')->onDelete('set null');
            $table->integer('vehicle_type_id');
            $table->integer('vehicle_owner_id');
            $table->string('vehicle_no')->unique();
            $table->string('model');
            $table->string('registration_no');
            $table->string('vehicle_image')->nullable(); // Field to store vehicle image path
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
