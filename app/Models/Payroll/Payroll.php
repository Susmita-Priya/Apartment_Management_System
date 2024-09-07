<?php

namespace App\Models\Payroll;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function data_inputed_by()
    {
        return $this->hasOne(User::class, 'id','generated_by');
    }
    
}
