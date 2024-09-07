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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->string('employee_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('nid')->nullable();
            $table->string('weekend')->nullable()->comment('saturday/sunday...');
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('emargency_contact_no')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('educational_qualification')->nullable();
            $table->string('image')->nullable();

            $table->date('joining_date')->nullable();

            $table->integer('machine_id')->nullable()->comment('for taking attendance by device');
            $table->integer('shifting_type')->nullable()->comment('normal/rostering shift');
            $table->integer('daily_working_hour')->nullable();
            $table->integer('shift_id')->nullable();

            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('employee_type_id')->nullable();
            $table->integer('job_location_id')->nullable();

            $table->integer('status')->default(1)->comment('1=active,0=inactive');

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
