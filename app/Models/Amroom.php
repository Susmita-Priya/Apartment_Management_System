<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amroom extends Model
{
    use HasFactory;

    protected $table = "amrooms";

    protected $fillable = [
        'unit_id',
        'balcony',
        'business_center',
        'gym',
        'hot_tub',
        'laundry_room',
        'library',
        'meeting_room',
        'mens_changing_room',
        'restaurant',
        'room_deck',
        'sauna',
        'swimming_pool',
        'theater_room',
        'womens_changing_room',
        'patio',
    ];

    public function extraRooms()
    {
        return $this->hasMany(Extraamroom::class);
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
