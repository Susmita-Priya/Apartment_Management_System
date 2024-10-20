<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = "units";

    protected $fillable = [
        'floor_id',
        'unit_id',
        'type',
        'rent',
        'status',
    ];

    // Define relationship with Floor
    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    // Define relationships for Residential and Commercial rooms
    public function resRoom()
    {
        return $this->hasOne(Resroom::class, 'unit_id');
    }

    public function comRoom()
    {
        return $this->hasOne(Comroom::class, 'unit_id');
    }

    // Define relationships for Mechanical, Administrative, Amenity, and Service rooms
    public function mechRoom()
    {
        return $this->hasOne(Mechroom::class, 'unit_id');
    }

    public function adminRoom()
    {
        return $this->hasOne(Adroom::class, 'unit_id');
    }

    public function amRoom()
    {
        return $this->hasOne(Amroom::class, 'unit_id');
    }

    public function serRoom()
    {
        return $this->hasOne(Serroom::class, 'unit_id');
    }

    // Access the building through the block
    public function block()
    {
        return $this->floor->block();
    }

    // Access the building through the block
    public function building()
    {
        return $this->floor->block->building();
    }

    // Define relationship with Unit_landlord
    public function landlords()
    {
        return $this->belongsToMany(Landlord::class, 'unit_landlords', 'unit_id', 'landlord_id');
    }

}
