<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantEmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_info_id',
        'full_name',
        'relationship',
        'email',
        'phone',
        'address',
    ];
}
