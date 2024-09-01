<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraserroom extends Model
{
    use HasFactory;

    protected $table = "ser_extra_rooms";

    protected $fillable = [
        'serroom_id',
        'room_name',
        'quantity',
    ];

    public function serRoom()
    {
        return $this->belongsTo(Serroom::class);
    }
}
