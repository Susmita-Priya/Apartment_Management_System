<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {

//     public function up(): void
//     {
//         Schema::create('blocks', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('company_id')->references('id')->on('users');
//             $table->foreignId('building_id')->references('id')->on('buildings')->onDelete('cascade');
//             $table->string('block_no')->unique();
//             $table->string('name');
//             $table->integer('total_upper_floors');
//             $table->integer('total_underground_floors');
            
//             $table->timestamps();
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('blocks');
//     }
// };
