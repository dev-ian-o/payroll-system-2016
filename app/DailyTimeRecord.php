<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyTimeRecord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'time_in', 'time_out',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
