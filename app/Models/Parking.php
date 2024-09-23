<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $table = 'parkings';

    public function stall()
    {
        return $this->belongsTo(StallLocker::class, 'stall_no');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_no');
    }

    public function parker()
    {
        return $this->belongsTo(Parker::class, 'parker_no');
    }
}
