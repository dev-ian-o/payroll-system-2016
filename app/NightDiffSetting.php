<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NightDiffSetting extends Model
{
    protected $fillable = [
        'nd_shift_time_start','nd_shift_time_end','nd_pay', 
    ];
}
