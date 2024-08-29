<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Residential Suite', 'Commercial Unit', 'Supporting and Servicing Unit', 'Parking Lot', 'Bike Lot', 'Storage Lot', 'Common Area']);
            $table->string('unit_id')->unique();
            $table->timestamps();

            $table->foreignId('floor_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
}
