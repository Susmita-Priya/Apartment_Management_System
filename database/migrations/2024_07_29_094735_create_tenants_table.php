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
            $table->id('id');
            $table->string('fullname',100);
            $table->string('email',100);
            $table->integer('phn');
            $table->integer('idno');
            $table->string('address',100);
            $table->enum('occ_status',["choose","employee","employer","others"]);
            $table->string('occ_place',100);
            $table->string('emphn');
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
