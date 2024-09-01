<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraamroom extends Model
{
    use HasFactory;

    protected $table = "am_extra_rooms";

    protected $fillable = [
        'amroom_id',
        'room_name',
        'quantity',
    ];

    public function amRoom()
    {
        return $this->belongsTo(Amroom::class);
    }
}
