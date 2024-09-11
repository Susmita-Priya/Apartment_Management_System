<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comroom extends Model
{
    use HasFactory;
    protected $table = "comrooms";

    protected $fillable = [
        'unit_id',
        'bathroom',
        'officeroom',
        'conferenceroom',
        'dining_room',
        'kitchen',
        'laundry',
        'solarium',
        'storage',
        'washroom'
    ];

    public function extraRooms()
    {
        return $this->hasMany(Extracomroom::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
