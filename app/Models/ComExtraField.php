<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComExtraField extends Model
{
    use HasFactory;
    protected $table = 'com_extra_fields';

    protected $fillable = [
        'comarea_id',
        'field_name',
    ];

    public function commonArea()
    {
        return $this->belongsTo(Comarea::class);
    }
}