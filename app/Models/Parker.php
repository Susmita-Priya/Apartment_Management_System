<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parker extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'parkers';

    // Define the fillable columns
    protected $fillable = [
        'company_id',
        'stall_no',
        'parker_no',
        'full_name',
        'email',
        'phone',
        'status',
    ];

}
