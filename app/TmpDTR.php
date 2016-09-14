<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDtr extends Model
{
    protected $fillable = [
        'employee_no', 'mode', 'datetime',
    ];

}
