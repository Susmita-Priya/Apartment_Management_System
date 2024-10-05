<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_assign extends Model
{
    use HasFactory;
    protected $table = "unit_assigns";

    protected $fillable = [
        'unit_id',
        'tenant_id',
        'landlord_id',
        'status',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
