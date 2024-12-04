<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];
}
