<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'unit_id',
        'room_type_id',
        'room_no',
        'amenities',
        'status'
    ];
}
