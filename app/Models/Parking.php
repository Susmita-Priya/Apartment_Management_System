<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $table = 'parkings';

    protected $fillable = [
        'stall_no',
        'vehicle_no',  // Storing as JSON
        'parker_no',
    ];

    // Specify casting to handle JSON automatically
    protected $casts = [
        'vehicle_no' => 'array', // This will cast vehicle_no to an array
    ];
    
    public function stalllocker()
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
