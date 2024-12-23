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

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(vehicleType::class);
    }

    public function vehicleOwner()
    {
        return $this->belongsTo(User::class, 'vehicle_owner_id');
    }
}
