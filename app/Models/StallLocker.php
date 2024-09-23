<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallLocker extends Model
{
    use HasFactory;

    protected $table = 'stalls_lockers';

    protected $fillable = [
        'floor_id',
        'stall_locker_no',
        'type',
    ];

    /**
     * Get the floor that owns the stall/locker.
     */
    public function floor()
    {
        return $this->belongsTo(Floor::class);
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

    // public function assets()
    // {
    //     return $this->hasMany(Asset::class, 'stall_locker_id');
    // }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'stall_no');
    }

    public function parkers()
    {
        return $this->hasMany(Parker::class, 'stall_no'); // Assuming the foreign key is 'stall_id'
    }

    public function parking()
    {
        return $this->hasOne(Parking::class, 'stall_no');
    }
    
}
