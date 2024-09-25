<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parker extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'parkers';

    // The attributes that are mass assignable
    protected $fillable = [
        'parker_no',        
        'parker_name',      
        'email',
        'phn',     
        'stall_no',          
        'status',            
    ];

    /**
     * Define the relationship between a vehicle and its assigned stall.
     * Each vehicle can be associated with one stall.
     */
    public function stalllocker()
    {
        return $this->belongsTo(StallLocker::class, 'stall_no');
    }

    // public function parkers()
    // {
    //     return $this->hasMany(Parker::class, 'stall_no');
    // }

    public function parkings()
    {
        return $this->hasMany(Parking::class, 'parker_no');
    }
}
