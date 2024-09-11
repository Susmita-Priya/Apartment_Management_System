<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'assets'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'room_stall_id',  // The associated room (foreign key)
        'room_id',     // Room identifier
        'assets_details',  // JSON column for asset details
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'assets_details' => 'array',  // Cast JSON to array
    ];

    /**
     * Get the resroom that the asset belongs to.
     */
     // Relationship with Resroom
     public function resroom()
     {
         return $this->belongsTo(Resroom::class);
     }
 
     // Relationship with Comroom
     public function comroom()
     {
         return $this->belongsTo(Comroom::class);
     }
 
     // Relationship with StallLocker
     public function stallLocker()
     {
         return $this->belongsTo(StallLocker::class, 'stall_locker_id');
     }
}
