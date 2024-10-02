<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenants';

    protected $fillable = [
        'image',
        'name',
        'father',
        'mother',
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
        'family_members',
        'family_members_details',
        'e_name',
        'e_rel',
        'e_add',
        'e_phone',
        'housemaid_name',
        'housemaid_nid',
        'housemaid_phone',
        'housemaid_address',
        'driver_name',
        'driver_nid',
        'driver_phone',
        'driver_address',
        'pre_owner_name',
        'pre_owner_phone',
        'pre_owner_address',
        'reason',
        'new_owner_name',
        'new_owner_phone',
        'new_house_start_date',
    ];

    protected $casts = [
        'family_members_details' => 'array',
    ];



    
}