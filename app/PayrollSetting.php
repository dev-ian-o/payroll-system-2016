<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'daily_start_shift','daily_end_shift','cutoff_dates', 
    ];
}
