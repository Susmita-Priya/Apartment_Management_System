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
        'unit_id',
        'document',
        'amount',
        'status'
    ];
}
