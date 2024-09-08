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
    protected $table = 'assets'; // Define the table name if it's different from the plural form of the model name

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'resroom_id',  // The associated room (foreign key)
        'room_id',     // Room identifier (e.g., "bedroom1", "bathroom2")
        'asset_name',  // The name of the asset (e.g., "Chair", "Table")
        'quantity',    // Quantity of the asset
    ];

    /**
     * Get the resroom that the asset belongs to.
     */
    public function resroom()
    {
        return $this->belongsTo(Resroom::class);
    }
}
