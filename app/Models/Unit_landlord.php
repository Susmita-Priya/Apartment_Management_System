<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_landlord extends Model
{
    use HasFactory;

    protected $table = 'unit_landlords';

    protected $fillable = ['unit_id', 'landlord_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }

}
