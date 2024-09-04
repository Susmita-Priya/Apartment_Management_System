<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraadroom extends Model
{
    use HasFactory;

    protected $table = "ad_extra_rooms";

    protected $fillable = [
        'adroom_id',
        'room_name',
        'quantity'
    ];

    public function adRoom()
    {
        return $this->belongsTo(Adroom::class);
    }
}
