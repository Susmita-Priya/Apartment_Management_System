<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resroom extends Model
{
    use HasFactory;
    protected $table = "resrooms";

    protected $fillable = [
        'unit_id',
        'bedroom',
        'bathroom',
        'balcony',
        'dining_room',
        'library_room',
        'kitchen',
        'storeroom',
        'laundry',
        'solarium',
        'washroom'
    ];

    public function extraRooms()
    {
        return $this->hasMany(Extraresroom::class);
    }

    public function asset()
    {
        return $this->hasMany(Asset::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

