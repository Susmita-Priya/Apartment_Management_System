<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'stall_id',
        'vehicle_type_id',
        'vehicle_owner_id',
        'vehicle_no',
        'model',
        'registration_no',
        'vehicle_image',
        'status'
    ];
}
