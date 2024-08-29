<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracomroom extends Model
{
    use HasFactory;

    protected $table = "com_extra_rooms";

    protected $fillable = [
        'comroom_id',
        'room_name',
        'quantity'
    ];

    public function comRoom()
    {
        return $this->belongsTo(Comroom::class);
    }
}
