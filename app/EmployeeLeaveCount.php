<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveCount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id','leave_type_id','total_leave_count','actual_leave_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
}
