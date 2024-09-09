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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();

            $table->integer('sl_no')->nullable();
            $table->string('name')->nullable();
            $table->double('price')->nullable();
            $table->double('discount_amount')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('role_id')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            $table->integer('subscription_package_duration_id')->nullable();
            $table->integer('user_id')->nullable();

            $table->integer('status')->default(1)->comment('1=active,0=inactive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_packages');
    }
};
