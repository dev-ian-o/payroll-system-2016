<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanRecord extends Model
{
    //
    protected $fillable = ['employee_id','loan_status','months_of_payment','loan_balance','loan_paid','loan_total'];

}
