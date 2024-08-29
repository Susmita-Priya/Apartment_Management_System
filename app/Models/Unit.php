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
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }
    public function resRoom()
    {
        return $this->hasOne(Resroom::class, 'unit_id');
    }
    public function comRoom()
    {
        return $this->hasOne(ComRoom::class);
    }
    public function block()
    {
        return $this->floor->block(); // Access the building through the block
    }
    public function building()
    {
        return $this->floor->block->building(); // Access the building through the block
    }
}
