<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $table = 'floors';

    protected $fillable = [
        'company_id',
        'building_id',
        'floor_no',
        'name',
        'type',
        'is_residential_unit_exist',
        'is_commercial_unit_exist',
        'is_supporting_room_exist',
        'is_parking_lot_exist',
        'is_storage_lot_exist',
        'status',
    ];


    // public function block()
    // {
    //     return $this->belongsTo(Block::class);
    // }

    // public function building()
    // {
    //     return $this->block->building(); // Access the building through the block
    // }

    // public function units()
    // {
    //     return $this->hasMany(Unit::class, 'floor_id');
    // }

    // public function stallsLockers()
    // {
    //     return $this->hasMany(StallLocker::class);
    // }
}
