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
        Schema::create('salary_heads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('head_type')->comment('1=addition,2=deduction')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('emp_create_status')->default(1)->comment('1=show when empoyee adding, 2=not show');
            $table->integer('status')->default(1)->comment('1=active,0=inactive');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_heads');
    }
};
