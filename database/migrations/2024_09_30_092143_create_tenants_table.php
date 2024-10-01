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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('father');
            $table->string('mother');
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
            $table->integer('family_members');
            $table->json('family_members_details')->nullable();
            $table->string('e_name')->nullable();
            $table->string('e_rel')->nullable();
            $table->string('e_add')->nullable();
            $table->string('e_phone')->nullable();
            $table->string('housemaid_name')->nullable();
            $table->string('housemaid_nid')->nullable();
            $table->string('housemaid_phone')->nullable();
            $table->text('housemaid_address')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_nid')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('driver_address')->nullable();
            $table->string('pre_owner_name')->nullable();
            $table->string('pre_owner_phone')->nullable();
            $table->string('pre_owner_address')->nullable();
            $table->text('reason')->nullable();
            $table->string('new_owner_name')->nullable();
            $table->string('new_owner_phone')->nullable();
            $table->date('new_house_start_date');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};