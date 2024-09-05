<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'firelane',
        'building_entrance',
        'corridors',
        'driveways',
        'emergency_stairways',
        'garden',
        'hallway',
        'loading_dock',
        'lobby',
        'parking_entrance',
        'patio',
        'rooftop',
        'stairways',
        'walkways',
    ];

    public function extraFields()
    {
        return $this->hasMany(ComExtraField::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}