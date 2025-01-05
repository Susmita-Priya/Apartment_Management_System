<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'landlord_id',
        'name',
        'phone',
        'email',
        'services_id',
        'note',
        'status',
    ];

    public function landlord()
    {
        return $this->belongsTo(User::class);
    }
}
