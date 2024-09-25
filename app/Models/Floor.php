<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $table = 'floors';

    protected $fillable = [
        'block_id',
        'floor_no',
        'name',
        'type',
        'residential_suite',
        'commercial_unit',
        'supporting_service_room',
        'parking_lot',
        'storage_lot',
    ];


    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function building()
    {
        return $this->block->building(); // Access the building through the block
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'floor_id');
    }

    public function stallsLockers()
    {
        return $this->hasMany(StallLocker::class);
    }
}
