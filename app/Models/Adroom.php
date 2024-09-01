<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adroom extends Model
{
    use HasFactory;

    protected $table = "adrooms";

    protected $fillable = [
        'unit_id',
        'accounting',
        'board_room',
        'building_manager_office',
        'business_center_room',
        'computer_it',
        'conference_room',
        'first_aid_room',
        'human_resource',
        'meeting_room',
        'property_manager_office',
        'registration_office',
        'sales_marketing',
        'security_concierge',
        'shipping_receiving',
        'workshop_room',
    ];

    public function extraRooms()
    {
        return $this->hasMany(Extraadroom::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

