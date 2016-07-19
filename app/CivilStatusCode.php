<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CivilStatusCode extends Model
{
    protected $fillable = [
        'civil_status','civil_status_desc'
    ];

}
