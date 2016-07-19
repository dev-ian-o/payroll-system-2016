<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'basic_pay','sss_contribution','pagibig_contribution','philhealth_contribution'
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
