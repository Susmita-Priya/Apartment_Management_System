<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serroom extends Model
{
    use HasFactory;

    protected $table = "serrooms";

    protected $fillable = [
        'unit_id',
        'garbage_chute',
        'garbage_recycling_room',
        'inventory_rooms',
        'janitorial_room',
        'laundry_room',
        'loading_dock',
        'lobby',
        'mailroom',
        'mens_bathroom',
        'mens_washroom',
        'shipping_receiving',
        'storage_room',
        'womens_bathroom',
        'womens_washroom',
        'workshop',
    ];

    public function extraRooms()
    {
        return $this->hasMany(Extraserroom::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
