<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id','salary_head_id','amount'];

    public function department()
    {
        return $this->hasOne(Department::class, 'id','department_id');
    }

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id','designation_id');
    }

    public function employee_type()
    {
        return $this->hasOne(EmployeeType::class, 'id','employee_type_id');
    }

    public function job_location()
    {
        return $this->hasOne(JobLocatin::class, 'id','job_location_id');
    }
}
