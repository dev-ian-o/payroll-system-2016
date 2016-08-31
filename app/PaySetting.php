<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaySetting extends Model
{
    protected $fillable = [
        'pay_type','first_nine_hrs_pay','excess_of_nine_hrs_pay', 
    ];
}
