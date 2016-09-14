
@include('admin.common.header')
	<!-- echo "<br>hrs of lates:$hours_of_late";
		echo "<br>days of absent:$days_of_absent";
		echo "<br>days of leave_without_pay:$days_of_leave_wo_pay";
		echo "<br>loan deduction:$loan_deduction";

		echo "<br>reqular_ot_hrs:$reqular_ot_hrs";
		echo "<br>rest_day_hrs:$rest_day_hrs";
		echo "<br>special_holiday_hrs:$special_holiday_hrs";
		echo "<br>special_holiday_rest_day_hrs:$special_holiday_rest_day_hrs";
		echo "<br>regular_holiday_hrs:$regular_holiday_hrs";
		echo "<br>regular_holiday_rest_day_hrs:$regular_holiday_rest_day_hrs";

		echo "<br>cutoff_basic_salary:".$covered_days_basic_salary; -->
 <div class="btn-group pull-right">
    <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
    <ul class="dropdown-menu">
        <li><a href="#" onClick ="$('#data-payroll').tableExport({type:'txt',escape:'false'});"><img src='{{ url('admin-assets/img/icons/txt.png')}}' width="24"/> TXT</a></li>
        <li><a href="#" onClick ="$('#data-payroll').tableExport({type:'excel',escape:'false'});"><img src='{{ url('admin-assets/img/icons/xls.png')}}' width="24"/> XLS</a></li>
        <li><a href="#" onClick ="$('#data-payroll').tableExport({type:'doc',escape:'false'});"><img src='{{ url('admin-assets/img/icons/word.png')}}' width="24"/> Word</a></li>
        <li><a href="#" onClick ="$('#data-payroll').tableExport({type:'pdf',escape:'false'});"><img src='{{ url('admin-assets/img/icons/pdf.png')}}' width="24"/> PDF</a></li>
    </ul>
</div>         

<div cladmin-assets="row" >

<table id="data-payroll" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Employee No</th>
            <th>Name</th>
            <th>Late deduction</th>
            <th>Absent deduction</th>
            <th>Loan deduction</th>
            <th>SSS/PAGIBIG/PHILHEALTH</th>
            <th>OT</th>
            <th>Basic Salary</th>
            <th>Total Deduction</th>
            <th>Witholding Tax</th>
            <th>Taxable Income</th>
            <th>Net Pay</th>
        </tr>
    </thead>
    <tbody>
    

          

<?php

$tax_table_directory = storage_path('json/witholdingtaxtable.json');
$sss_table_directory = storage_path('json/ssscontributiontable.json');
$philhealth_table_directory = storage_path('json/philhealthtable.json');

// $tax_table = stripslashes(File::get($tax_table_directory));

$tax_table = json_decode(File::get($tax_table_directory),true);
$sss_table = json_decode(File::get($sss_table_directory),true);
$philhealth_table = json_decode(File::get($philhealth_table_directory),true);
 // json_last_error() ;

if (isset($_GET['cutoff_month'])) { $cutoff_month = $_GET['cutoff_month']; }else { $cutoff_month = 8 ; }
if (isset($_GET['cutoff_year'])) { $cutoff_year = $_GET['cutoff_year']; }else { $cutoff_year = 2016 ; }
if (isset($_GET['place_of_cutoff'])) { $place_of_cutoff = $_GET['place_of_cutoff']; }else { $place_of_cutoff = 2016 ; }



// $employee_id = 1;
// $cutoff_month = $_GET['cutoff_month']; // 1-12 current and below
// $cutoff_year = $_GET['cutoff_year']; // current and below

// $place_of_cutoff = $_GET['place_of_cutoff']; // 1st or 2nd>
// $employee = App\Employee::where('employees.deleted_at', '=', NULL)
//                                                 ->where('employees.id','=',$employee_id)
//                                                 ->leftJoin('salaries', 'salaries.id', '=', 'employees.salary_id')
//                                                 ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
//                                                 ->get();


	$num = 1;
foreach (App\Employee::where('employees.deleted_at', '=', NULL)->get() as $ki => $balue) {
	$employee_id = $balue->id;	
	// echo "<br>==================";
	// echo "<br>".$balue;			

//allowances
//non-taxable income/allowance deminis benefits

//check if valid month, this month and below --done
//check if current year or below. -- done
//check if place of cutoff is between the covered days -- done
//compute for covered days * $pay_per_day -- done
//compute for deductions:
	//lates --- query from dtr
	//absents/leave w/o pay --- query from dtr and emp_leave
	//philhealth/sss/pagibig -- done
	//loans -- query from loan_records
//compute for overtime and night diff --- query from overtime records
	//for night-diff --- query from dtr
	//for overtime --- query from overtime records.. //query from pay setting // check date if holiday restday or regular workday //


//add deduction and additional(ot and nd) to basic salary based on covered days
//gross is total without the witholding tax deductions
//compute witholding tax
//total taxable income minus withholding tax
//NET PAY

//PAYROLL SETTING (start_shift,end_shift,cutoff_dates) 
$payroll_setting = App\PayrollSetting::where('deleted_at',null)->orderBy('created_at','DESC')->first();
$start_shift = Carbon\Carbon::createFromFormat('H:i:s', $payroll_setting->daily_start_shift );
$end_shift = Carbon\Carbon::createFromFormat('H:i:s', $payroll_setting->daily_end_shift );
$cutoff_dates = json_decode($payroll_setting->cutoff_dates);
// echo $start_shift;
// echo "<br>";
// echo $end_shift;
// echo "<br>";
//NIGHT DIFF SETTING
$nd_setting = App\NightDiffSetting::where('deleted_at',null)->orderBy('created_at','DESC')->first();
$nd_start_shift = Carbon\Carbon::createFromFormat('H:i:s', $nd_setting->nd_shift_time_start );
$nd_end_shift = Carbon\Carbon::createFromFormat('H:i:s', $nd_setting->nd_shift_time_end );
// $nd_start_shift = $nd_setting->nd_shift_time_start;
// $nd_end_shift = $nd_setting->nd_shift_time_end;



if($place_of_cutoff == 1) { $cutoff_day = $cutoff_dates->_1; } else if($place_of_cutoff == 2){ $cutoff_day = $cutoff_dates->_2; }

$dt_today = Carbon\Carbon::now();
$dt_cutoff_setting = Carbon\Carbon::create($cutoff_year, $cutoff_month, $cutoff_day, 23, 59, 59);
$dt_covered_days_start = Carbon\Carbon::create($cutoff_year, $cutoff_month, $cutoff_day, 00, 00, 00)->subDays(15);
$dt_covered_days_end = Carbon\Carbon::create($cutoff_year, $cutoff_month, $cutoff_day, 23, 59, 59);


if($dt_today->gte($dt_cutoff_setting)) //change to gte next time
{
	//computation here... 
	$employee = getEmployee($employee_id);
	$basic_salary = $employee['basic_pay'];
	// $pay_per_hour = (($basic_salary * 12) / 313) / 8;
	$pay_per_hour = ($basic_salary /20 ) / 8;
	$pay_per_day = $pay_per_hour * 8;
	
	$total_covered_weekdays = $dt_covered_days_end->diffInDaysFiltered(function(Carbon\Carbon $date) {
       return $date->isWeekday();
    }, $dt_covered_days_start); // query number of days within period cover
	// echo "<pre>";
	$covered_days_basic_salary = $pay_per_day * $total_covered_weekdays;
	// echo $dt_covered_days_start;
	// echo "<br>";
	// echo $dt_covered_days_end;
	// echo "<br>";
	$hours_of_late = 0;
	foreach (App\DailyTimeRecord::where('deleted_at','=',NULL)
					->whereDate('time_in','>=',$dt_covered_days_start)
					->whereDate('time_out','<=',$dt_covered_days_end)
					->where('employee_id','=',$employee_id)
					->get() as $key => $value) {
		// var_dump($value->time_in);
		$time_in = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in );
		$time_out = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_out );
		$start_shift = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_in->toDateString().' '. $payroll_setting->daily_start_shift );
		$end_shift = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_in->toDateString().' '.$payroll_setting->daily_end_shift );
		// echo "=============";
		// echo "<br>";
		// echo $end_shift;
		// echo "<br>";
		// echo $time_out;
		// echo "<br>";
		// //1st get
		// echo $time_in->lte($nd_start_shift) ;
		// echo $time_out->gte($nd_end_shift) ;
		if(! $time_in->lte($start_shift))
				$hours_of_late = ($start_shift->diffInMinutes($end_shift)/60) - (floor($time_in->diffInMinutes($end_shift)/60)); 

		//check if early out
		// if($end_shift->lt($time_out))
		// 		echo "naearlyout<br>";
		// if(! $time_in->gte($start_shift))
				 // echo "not late"; echo "<br>";


			// compute late
	}

	$oldest_datetime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dt_covered_days_start )->format('Y-m-d');     
    $latest_datetime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dt_covered_days_end )->format('Y-m-d');     
    
    $oldest_datetime = strtotime($oldest_datetime . " 12:00");
    $latest_datetime = strtotime($latest_datetime . " 12:00");
    //check for absent
    $days_of_absent = 0;
    $days_of_leave_wo_pay = 0;

	for ( $i = $oldest_datetime; $i <= $latest_datetime; $i = $i + 86400 ) 
	{
       $thisDate = date( 'Y-m-d', $i );
       $thisDate =  Carbon\Carbon::createFromFormat('Y-m-d', $thisDate );
       $check_if_holiday = App\Holiday::where('deleted_at','=',NULL)
       				->whereDate('date','=',$thisDate->toDateString())
       				->exists();

       $check_if_leave = App\EmployeeLeaveRecord::where('deleted_at','=',NULL)
       				->whereDate('date_from','<=',$thisDate->toDateString())
       				->whereDate('date_to','>=',$thisDate->toDateString())
       				->where('employee_id','=',$employee_id)
       				->exists();
       // echo "<br>".$check_if_leave;	
       // echo "<br>holiday:".$check_if_holiday;	
       # code...
       $check_if_present = App\DailyTimeRecord::where('deleted_at','=',NULL)
       				->whereDate('time_in','=',$thisDate->toDateString())
       				->where('employee_id','=',$employee_id)
       				->exists();

      	$check_if_pay_wo_leave =  App\EmployeeLeaveRecord::where('deleted_at','=',NULL)
       				->whereDate('date_from','<=',$thisDate->toDateString())
       				->whereDate('date_to','>=',$thisDate->toDateString())
       				->where('employee_id','=',$employee_id)
       				->where('leave_type_id','=','3')
       				->exists();
		
		if(!$thisDate->isWeekEnd() && !$check_if_holiday && !$check_if_leave && !$check_if_present)
        {
        	$days_of_absent++;
		}

		if(!$thisDate->isWeekEnd() && !$check_if_holiday && $check_if_pay_wo_leave)
		{
			$days_of_leave_wo_pay++;
		}



	}

	$check_if_have_loan = App\LoanRecord::where('deleted_at','=',NULL)
							->where('employee_id','=',$employee_id)
							->whereDate('created_at','<=',$dt_cutoff_setting->toDateString())
							->exists();
	$loan_deduction = 0;					

	if($check_if_have_loan && $place_of_cutoff == 2) //change to 1
	{
		$loan_record = App\LoanRecord::where('deleted_at','=',NULL)
							->where('employee_id','=',$employee_id)
							->whereDate('created_at','<=',$dt_cutoff_setting->toDateString())
							->first();

		

		$loan_start = Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,$loan_record->created_at);
		$loan_end = Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,$loan_record->created_at)->addMonths($loan_record->months_of_payment - 1);
		// $dt_cutoff_setting;

		$monthDiff = $loan_start->diffInMonths($dt_cutoff_setting) + 1;
		// echo $loan_start; 
		// echo "<br>$loan_start";
		// echo "<br>$dt_cutoff_setting";
		// echo "<br>$monthDiff";
		$num_of_months_paid = ($loan_record->loan_paid * $loan_record->months_of_payment)/$loan_record->loan_total;
		

		$loan_deduction = $loan_record->loan_total / $loan_record->months_of_payment;

		if($num_of_months_paid < $monthDiff)
		{
			if($loan_record->loan_total - ($loan_record->loan_paid + $loan_deduction) == 0){ $loan_stats = 1;} else {$loan_stats = 0;} 
			$loan = App\LoanRecord::find($loan_record->id);
			$loan->loan_paid = $loan_record->loan_paid + $loan_deduction;
			$loan->loan_balance = $loan_record->loan_total - ($loan_record->loan_paid + $loan_deduction) ;
			$loan->loan_status = $loan_stats ;
			$loan->save();
		}
	}


	//compute for overtime and night diff --- query from overtime records
	//for night-diff --- query from dtr
	//for overtime --- query from overtime records.. //query from pay setting // check date if holiday restday or regular workday //
	
	// $night_diff_hours = 0;
	// $reg_overtime = 0;
	// $restday_overtime = 0;
	// $reg_overtime_nd = 0;
	// $rest_day_ot_nd = 0;

	$reqular_ot_hrs = 0;
	$rest_day_hrs = 0;
	$special_holiday_hrs = 0;
	$special_holiday_rest_day_hrs = 0;
	$regular_holiday_hrs = 0;
	$regular_holiday_rest_day_hrs = 0;

	foreach(App\OvertimeRecord::where('deleted_at','=',NULL)
				->where('employee_id','=',$employee_id)
				->whereDate('date_from','>=',$dt_covered_days_start)
				->whereDate('date_to','<=',$dt_covered_days_end)
				->get() as $key => $value)
	{
		$dt_date_from = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->date_from);
		$dt_date_to = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->date_to);


		$check_if_special_holiday = App\Holiday::where('deleted_at','=',NULL)
				->whereDate('date','=', $dt_date_from)
				->where('holiday_type_id','=',2)
				->exists();

		$check_if_regular_holiday = App\Holiday::where('deleted_at','=',NULL)
				->whereDate('date','=', $dt_date_from)
				->where('holiday_type_id','=',1)
				->exists();

		$check_if_rest_day = $dt_date_from->isWeekEnd();
		// echo "$check_if_special_holiday $check_if_rest_day $check_if_rest_day"; 
		if($check_if_special_holiday && $check_if_rest_day)
		{
			$special_holiday_rest_day_hrs = $dt_date_from->diffInHours($dt_date_to,true);
		}
		else if ($check_if_regular_holiday && $check_if_rest_day)
		{
			$regular_holiday_rest_day_hrs = $dt_date_from->diffInHours($dt_date_to,true);
		}
		else if ($check_if_regular_holiday)
		{
			$regular_holiday_hrs = $dt_date_from->diffInHours($dt_date_to,true);
		}
		else if ($check_if_special_holiday)
		{
			$special_holiday_hrs = $dt_date_from->diffInHours($dt_date_to,true);
		}
		else if ($check_if_rest_day)
		{
			$rest_day_hrs = $dt_date_from->diffInHours($dt_date_to,true);
		}
		else
		{
			$reqular_ot_hrs = $dt_date_from->diffInHours($dt_date_to,true);
		}

		
	}



	// echo "<br>hrs of lates:$hours_of_late";
	// echo "<br>days of absent:$days_of_absent";
	// echo "<br>days of leave_without_pay:$days_of_leave_wo_pay";
	// echo "<br>loan deduction:$loan_deduction";

	// echo "<br>reqular_ot_hrs:$reqular_ot_hrs";
	// echo "<br>rest_day_hrs:$rest_day_hrs";
	// echo "<br>special_holiday_hrs:$special_holiday_hrs";
	// echo "<br>special_holiday_rest_day_hrs:$special_holiday_rest_day_hrs";
	// echo "<br>regular_holiday_hrs:$regular_holiday_hrs";
	// echo "<br>regular_holiday_rest_day_hrs:$regular_holiday_rest_day_hrs";

	// echo "<br>cutoff_basic_salary:".$covered_days_basic_salary;

	//compute for deductions:
	//lates --- query from dtr time within shift check if how many hrs late --- done
	// check within covered days except holiday and restday shift_start_time > 
	// early out...
	//absents --- query from dtr check if holiday or restday --done
	//leave w/o pay --- query from dtr and emp_leave  -- done
	//philhealth/sss/pagibig -- done gawan ng function ---done 
	//loans -- query from loan_records --done

	// echo "pay_per_day:".$pay_per_day;
	// echo "<br>";


	$late_deduction = $hours_of_late * $pay_per_hour;
	$absent_deduction = $days_of_absent * $pay_per_day;
	$leave_wo_pay_deduction = $days_of_leave_wo_pay * $pay_per_day;


	 
	 foreach (App\PaySetting::get() as $key => $value) {
	 	if($value->pay_type === "Regular Workday" )
		{
			$addtnl_reqular_ot_hrs = ($reqular_ot_hrs * $pay_per_hour * $value->excess_of_nine_hrs_pay) / 100;	
		}

		if($value->pay_type === "Rest Day" )
		{ 
			$addtnl_rest_day_hrs = ($rest_day_hrs * $pay_per_hour * $value->first_nine_hrs_pay) / 100;	
		}
		if($value->pay_type === "Special Holiday" )
		{ 
			$addtnl_special_holiday_hrs = ($special_holiday_hrs * $pay_per_hour * $value->first_nine_hrs_pay) / 100;
		}

		if($value->pay_type === "Special Holiday on Rest Day" )
		{ 
			$addtnl_special_holiday_rest_day_hrs = ($special_holiday_rest_day_hrs * $pay_per_hour * $value->first_nine_hrs_pay) / 100;
		}

		if($value->pay_type === "Regular Holiday" )
		{ 
			$addtnl_regular_holiday_hrs = ($regular_holiday_hrs * $pay_per_hour * $value->first_nine_hrs_pay) / 100;
		}

		if($value->pay_type === "Regular Holiday on Rest Day" )
		{ 
			$addtnl_regular_holiday_rest_day_hrs = ($regular_holiday_rest_day_hrs * $pay_per_hour * $value->first_nine_hrs_pay) / 100;
		}
	 }
	

	$total_deductions = $late_deduction+$absent_deduction+$leave_wo_pay_deduction+$loan_deduction+$employee['sss_contribution']+$employee['pagibig_contribution']+$employee['philhealth_contribution'];
	$total_additionals =  ($addtnl_reqular_ot_hrs + $addtnl_rest_day_hrs + $addtnl_special_holiday_hrs + $addtnl_special_holiday_rest_day_hrs + $addtnl_regular_holiday_hrs + $addtnl_regular_holiday_rest_day_hrs);


	// $taxable_income =  $covered_days_basic_salary - (deductions) - (sss/philhealth/pagibig) + (OT/ND)
	$taxable_income =  ($covered_days_basic_salary  + $total_additionals) - $total_deductions;


	
}
else
{
	echo "Payroll cutoff dates not yet available.";
}













// $taxable_income = $basic_salary - ($philhealth_contribution + $sss_contribution + $pagibig_contribution);
$excess = 0;
// echo "<br>";
// echo "taxable_income:".$tan(arg)axable_income;
// $taxable_income = 8558.00;
// dd($tax_table[0]['witholdingtax'][0]['table']);
// dd($tax_table);
$witholdingtax = 0;
$civil_status = App\CivilStatusCode::where('id','=', $employee['civil_status_code_id'])->pluck('id_json');
$civil_status = $civil_status[0];
// echo $civil_status[0];
foreach ($tax_table[0]['witholdingtax'][0]['table'] as $key => $value) {
	// echo "<br>";
	// echo $civil_status .' '.  $value['status'];
	// echo "<br>";
	// echo $taxable_income .' '.  $value['basicsalary'];
	// echo "<br>";
	// echo $civil_status .' '.  $value['id'];
	// echo "<br>";
	// echo "===================";
	if($civil_status == $value['id'] && $value['basicsalary'] <= $taxable_income)
	{
		// echo "<br>";
		// echo $value['basicsalary'];
		// echo "asd";
		$excess = (($taxable_income - $value['basicsalary']) * $value['percent']) / 100;
		$witholdingtax = $value['tax'] + $excess;
		break;
	}


};
// echo "witholdingtax:".$witholdingtax;

$net_pay = $taxable_income - $witholdingtax ;
// echo "<br>net_pay:" .$net_pay;

// 	echo "<br>total_additionals:$total_additionals";
// 	echo "<br>total_deductions:$total_deductions";
// 	echo "<br>taxable_income:$taxable_income";

		echo "<tr>";
            echo "<td> ".$num++." </td>";
            echo "<td>".$employee['employee_no']."</td>";
            echo "<td>".$employee['lastname'].",".$employee['firstname']."</td>";
            echo "<td>$late_deduction</td>";
            echo "<td>$absent_deduction</td>";
            echo "<td>$loan_deduction</td>";
            echo "<td>".($employee['sss_contribution']+$employee['pagibig_contribution']+$employee['philhealth_contribution'])."</td>";
            echo "<td>$total_additionals</td>";
            echo "<td>$covered_days_basic_salary</td>";
            echo "<td>$total_deductions</td>";
            echo "<td>$witholdingtax</td>";
            echo "<td>$taxable_income</td>";
            echo "<td>$net_pay</td>";
        echo "</tr>";


   
}

function getEmployee($employee_id){
	$employee_id = $employee_id;
	$employee = App\Employee::where('employees.deleted_at', '=', NULL)
        ->where('employees.id','=',$employee_id)
        ->leftJoin('salaries', 'salaries.id', '=', 'employees.salary_id')
        ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
        ->get();

	return $employee[0];

}

?>
</tbody>
</table>
</div>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/jquery/jquery-ui.min') }}.js"></script>
    <script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/bootstrap/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/tableexport/tableExport.js')}}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/tableexport/jquery.base64.js')}}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/tableexport/html2canvas.js')}}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/tableexport/jspdf/libs/sprintf.js')}}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/tableexport/jspdf/jspdf.js')}}"></script>
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/tableexport/jspdf/libs/base64.js')}}"></script>        	
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins.js') }}"></script>        
	<script type="text/javascript" src="{{ URL::to('admin-assets/js/actions.js') }}"></script> 

