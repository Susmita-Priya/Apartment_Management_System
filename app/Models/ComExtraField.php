<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComExtraField extends Model
{
    use HasFactory;

    protected $fillable = [
        'comarea_id',
        'field_name',
    ];

    public function comarea()
    {
        return $this->belongsTo(Comarea::class);
    }
}