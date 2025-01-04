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
        Schema::create('tenant_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landlord_id');
            $table->unsignedBigInteger('tenant_id'); 
            $table->unsignedBigInteger('building_id'); 
            $table->unsignedBigInteger('floor_id'); 
            $table->unsignedBigInteger('unit_id'); 
            $table->string('document')->nullable(); 
            $table->integer('rent'); 
            $table->integer('rent_advance_received'); 
            $table->date('lease_start_date'); 
            $table->date('lease_end_date'); 
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_agreements');
    }
};
