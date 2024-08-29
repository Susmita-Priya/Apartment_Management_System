<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraresroom extends Model
{
    use HasFactory;
    protected $table = "extra_rooms";

    protected $fillable = [
        'resroom_id',
        'room_name',
        'quantity'
    ];

    public function resRoom()
    {
        return $this->belongsTo(Resroom::class);
    }
}
