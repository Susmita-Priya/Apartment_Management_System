<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'tenant_id',
        'building_id',
        'floor_id',
        'unit_id',
        'document',
        'rent',
        'rent_advance_received',
        'lease_start_date',
        'lease_end_date',
        'status'
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class);
    }

    public function landlord()
    {
        return $this->belongsTo(User::class);
    }

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

    // public function units()
    // {
    //     return $this->hasMany(Unit::class);
    // }
}
