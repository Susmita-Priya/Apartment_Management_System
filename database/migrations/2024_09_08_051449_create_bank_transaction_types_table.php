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
        Schema::create('bank_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('type')->nullable()->comment('1=debit,2=credit');
            $table->integer('status')->default(1)->comment('1=active,0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transaction_types');
    }
};
