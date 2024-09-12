
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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->morphs('assetable'); // Polymorphic relationship columns
            $table->string('room_no');   // Room identifier (e.g., "bedroom1", "bathroom1")
            $table->json('assets_details'); // JSON column for asset details
            $table->timestamps();

            $table->unique(['assetable_id', 'assetable_type', 'room_no']); // Unique constraint for polymorphic relation
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};

