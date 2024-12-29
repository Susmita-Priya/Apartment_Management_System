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
        Schema::create('subscription_user_infos', function (Blueprint $table) {
            $table->id();

            $table->integer('subscription_package_id')->nullable();
            $table->integer('subscription_package_duration_id')->nullable();
            $table->double('package_price')->nullable();
            $table->double('discount_amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('payment_details')->nullable();
            $table->date('subcription_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->double('total_payable_amount')->nullable();
            $table->double('total_paid_amount')->nullable();

            $table->integer('user_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_user_infos');
    }
};
