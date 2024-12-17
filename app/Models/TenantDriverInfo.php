<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantDriverInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_info_id',
        'full_name',
        'email',
        'phone',
        'nid',
        'address',
    ];
}
