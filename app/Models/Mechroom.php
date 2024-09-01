<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechroom extends Model
{
    use HasFactory;

    protected $table = "mechrooms";

    protected $fillable = [
        'unit_id',
        'backup_generator',
        'boilers_room',
        'compactor_room',
        'electrical_room',
        'elevator_mechanical_room',
        'elevators_pit_room',
        'elevators_room',
        'emergency_hydro_room',
        'fan_room',
        'fire_extinguishers',
        'fire_panel',
        'garbage_chute',
        'hvac_mechanical_room',
        'hydro_room',
        'mechanical_room',
        'phone_cable_room',
        'recycling_room',
        'sprinklers_room',
        'swimming_pool_mechanical_room',
        'water_pump_room',
    ];

    public function extraRooms()
    {
        return $this->hasMany(Extramechroom::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
