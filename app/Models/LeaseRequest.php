<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'landlord_id',
        'unit_id',
        'start_date',
        'status',
    ];

    // Define relationship with Tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    // Define relationship with Landlord
    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'landlord_id');
    }

    // Define relationship with Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
