<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use HasFactory;

    protected $table = 'stalls';

    protected $fillable = [
        'company_id',
        'floor_id',
        'type',
        'stall_no',
        'capacity',
        'status',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'stall_id');
    }

}
