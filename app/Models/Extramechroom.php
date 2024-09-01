<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extramechroom extends Model
{
    use HasFactory;

    protected $table = "mech_extra_rooms";

    protected $fillable = [
        'mechroom_id',
        'room_name',
        'quantity'
    ];

    public function mechRoom()
    {
        return $this->belongsTo(Mechroom::class);
    }
}
