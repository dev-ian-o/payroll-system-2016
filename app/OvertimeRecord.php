<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OvertimeRecord extends Model
{
    //
    protected $fillable = [
        'employee_id','date_from','date_to'
    ];

}
