<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function up(): void
    {
        Schema::create('landlords', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('nid')->unique();
            $table->string('tax_id');
            $table->string('passport')->nullable();
            $table->string('driving_license')->nullable();
            $table->date('dob');
            $table->string('marital_status');
            $table->string('per_address');
            $table->string('occupation');
            $table->string('company')->nullable();
            $table->string('religion');
            $table->string('qualification')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('landlords');
    }
};
