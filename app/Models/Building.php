<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'building_no', 
        'name', 
        'image', 
        'type', 
        'total_upper_floors',
        'total_underground_floors',
        'common_area',
        'note',
        'status'];

    // // Define the relationship with Block model
    // public function blocks()
    // {
    //     return $this->hasMany(Block::class);
    // }
}
