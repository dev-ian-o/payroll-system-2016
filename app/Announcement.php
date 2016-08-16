<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
       protected $fillable = [
        'announcements','date_from','date_to',
    ];

}
