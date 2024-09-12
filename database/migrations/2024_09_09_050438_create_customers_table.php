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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->date('registration_date')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');

            $table->string('company_name')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('subscription_package_id')->nullable();
            $table->integer('subscription_package_duration_id')->nullable();
            $table->double('package_price')->nullable();
            $table->double('discount_amount')->nullable();

            $table->integer('payment_method')->nullable();
            $table->text('payment_details')->nullable();

            $table->string('status')->default(2)->comment('1=active | 0=inactive | 2=pending');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
