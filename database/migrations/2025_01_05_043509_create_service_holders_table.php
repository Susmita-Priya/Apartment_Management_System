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
        Schema::create('service_holders', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');  
            $table->integer('landlord_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->json('services_id');
            $table->string('note')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_holders');
    }
};
