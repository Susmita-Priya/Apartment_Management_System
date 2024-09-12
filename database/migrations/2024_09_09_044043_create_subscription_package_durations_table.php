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
        Schema::create('subscription_package_durations', function (Blueprint $table) {
            $table->id();
            $table->integer('value')->nullable();
            $table->integer('type')->nullable()->comment('1=day,2=week,3=month,4=year');
            $table->text('remarks')->nullable();
            $table->integer('status')->default(1)->comment('1=active,0=inactive');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_package_durations');
    }
};
