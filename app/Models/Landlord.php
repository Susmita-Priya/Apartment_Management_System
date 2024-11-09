<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
        'phone',
        'email',
        'nid',
        'tax_id',
        'passport',
        'driving_license',
        'dob',
        'marital_status',
        'per_address',
        'occupation',
        'company',
        'religion',
        'qualification',
    ];

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_landlords', 'landlord_id', 'unit_id');   
        
        //landlord model has many-to-many relationship with unit model and unit_landlords is pivot table , where landlord_id and unit_id are foreign keys
    }
}
