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
        Schema::create('landlord_agreements', function (Blueprint $table) {
            $table->id();
            $table->integer('landlord_id');
            $table->integer('company_id');
            $table->integer('building_id');
            $table->integer('floor_id');
            $table->integer('unit_id');
            $table->string('document')->nullable();
            $table->string('amount');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landlord_agreements');
    }
};
