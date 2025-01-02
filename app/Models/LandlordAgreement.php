<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandlordAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'company_id',
        'building_id',
        'floor_id',
        'unit_id',
        'document',
        'amount',
        'status'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function landlord()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(User::class);
    }


}
