<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $table = "blocks";

    protected $fillable = ['block_id', 'name', 'building_id'];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
}
