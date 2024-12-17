<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_info_id',
        'fathers_name',
        'mothers_name',
        'nid',
        'tax_id',
        'passport_no',
        'driving_license',
        'religion',
        'marital_status',
        'gender',
        'dob',
        'total_family_members',
    ];
}
