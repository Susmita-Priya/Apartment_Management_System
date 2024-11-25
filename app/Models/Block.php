<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','block_no', 'name', 'building_id', 'total_upper_floors', 'total_underground_floors'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    // public function floors()
    // {
    //     return $this->hasMany(Floor::class, 'block_id');
    // }

    // public function commonArea()
    // {
    //     return $this->hasOne(Comarea::class, 'block_id');
    // }
    
}
