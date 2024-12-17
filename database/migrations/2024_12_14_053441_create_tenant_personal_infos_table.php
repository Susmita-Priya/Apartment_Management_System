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
        Schema::create('tenant_personal_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_info_id')->references('id')->on('tenant_contact_infos')->constrained()->cascadeOnDelete();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('nid')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->integer('total_family_members')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_personal_infos');
    }
};
