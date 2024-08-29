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
        Schema::create('resrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Assuming each room is associated with a unit
            $table->integer('bedroom')->default(0);
            $table->integer('bathroom')->default(0);
            $table->integer('balcony')->default(0);
            $table->integer('dining_room')->default(0);
            $table->integer('library_room')->default(0);
            $table->integer('kitchen')->default(0);
            $table->integer('storeroom')->default(0);
            $table->integer('laundry')->default(0);
            $table->integer('solarium')->default(0);
            $table->integer('washroom')->default(0);
            $table->timestamps();
        });

        Schema::create('extra_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resroom_id')->constrained()->onDelete('cascade');
            $table->string('room_name');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_rooms');
        Schema::dropIfExists('resrooms');
    }
};