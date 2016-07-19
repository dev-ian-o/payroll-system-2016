<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_no', 'firstname', 'lastname','middlename','birthdate', 'address', 'city','province','zip_code', 'salary_id', 'civil_status_code_id','employee_leave_id','employee_leave_count_id', 'image',
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
