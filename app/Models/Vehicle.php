<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'vehicles';

    // The attributes that are mass assignable
    protected $fillable = [
        'vehicle_no',        // Vehicle Number
        'vehicle_name',      // Vehicle Name
        'vehicle_type',      // Vehicle Type (Car, Bike, or custom)
        'owner_name',        // Owner's Name
        'stall_no',          // Stall ID (if assigned to a stall)
        'status',            // Status to indicate if assigned to a stall
    ];

    /**
     * Define the relationship between a vehicle and its assigned stall.
     * Each vehicle can be associated with one stall.
     */
    public function stalllocker()
{
    return $this->belongsTo(StallLocker::class, 'stall_no');
}

}
