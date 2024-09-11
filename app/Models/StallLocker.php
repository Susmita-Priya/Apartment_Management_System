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

    public function assets()
    {
        return $this->hasMany(Asset::class, 'stall_locker_id');
    }
}
