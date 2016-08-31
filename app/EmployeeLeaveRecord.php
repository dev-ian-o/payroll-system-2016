<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveRecord extends Model
{
    
    protected $fillable = [
        'date_from', 'date_to', 'employee_id','leave_type_id'
    ];
}
