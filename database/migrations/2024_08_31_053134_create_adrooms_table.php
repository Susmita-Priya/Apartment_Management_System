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
        Schema::create('adrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Each administrative room is associated with a unit
            $table->integer('accounting')->default(0);
            $table->integer('board_room')->default(0);
            $table->integer('building_manager_office')->default(0);
            $table->integer('business_center_room')->default(0);
            $table->integer('computer_it')->default(0);
            $table->integer('conference_room')->default(0);
            $table->integer('first_aid_room')->default(0);
            $table->integer('human_resource')->default(0);
            $table->integer('meeting_room')->default(0);
            $table->integer('property_manager_office')->default(0);
            $table->integer('registration_office')->default(0);
            $table->integer('sales_marketing')->default(0);
            $table->integer('security_concierge')->default(0);
            $table->integer('shipping_receiving')->default(0);
            $table->integer('workshop_room')->default(0);
            $table->timestamps();
        });

        Schema::create('ad_extra_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adroom_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('ad_extra_rooms');
        Schema::dropIfExists('adrooms');
    }
};
