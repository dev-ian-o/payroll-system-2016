<?php

$tax_table_directory = storage_path('json/witholdingtaxtable.json');
$sss_table_directory = storage_path('json/ssscontributiontable.json');
$philhealth_table_directory = storage_path('json/philhealthtable.json');

$tax_table = json_decode(File::get($tax_table_directory),true);
$sss_table = json_decode(File::get($sss_table_directory),true);
$philhealth_table = json_decode(File::get($philhealth_table_directory),true);


$employee_id = 1;


$employee = App\Employee::where('employees.deleted_at', '=', NULL)
                                                ->where('employees.id','=',$employee_id)
                                                ->leftJoin('salaries', 'salaries.id', '=', 'employees.salary_id')
                                                ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
                                                ->get();


$basic_salary = 11000;

$pay_per_hour = (($basic_per_salary * 12) / 313) / 8;
$pay_per_day = $pay_per_hour * 8;


$worked_days = 0; // query number of days within period cover
$cutoff_basic_salary = $pay_per_day * $worked_days;


////DEDUCTIONS

$late_hours = 0; //query number of hours based on daily time record..
$



$basic_salary = 11000;
$civil_status= "S2/M2";
$overtime_pay = 2500;
$deductions = 2500;
$employee = true;
$period = "monthly";
$MAX_MONTHLY_COMPENSATION = 5000;


$witholdingtax = 0;
$sss_contribution = 0;
$philhealth_contribution = 0;
$pagibig_contribution = 0;
$tax_deduction = 0;


// dd($tax_table);
// dd($sss_table[0]['employed'][0]);

echo "<pre>";
#COMPUTE SSS CONTRIBUTION
if($employee === true)
{
	foreach ($sss_table[0]['employed'] as $key => $value)
	{
		if ($value['rangeofcompensationstart'] <= $basic_salary && $value['rangeofcompensationend'] >= $basic_salary)
		{
			if ($period === "semimonthly")
				$sss_contribution = $value['ee'] / 2;
			else
				$sss_contribution = $value['ee'];
		}


		if ($basic_salary < 1000)
		{
			if ($value['rangeofcompensationstart'] === 1000.00)
			{	
				if ($period === "semimonthly")
					$sss_contribution = $value['ee'] / 2;
				else
					$sss_contribution = $value['ee'];
			}
		}


		if ($basic_salary > 30000)
		{
			if ($value['rangeofcompensationend'] === 30000.00)
			{	
				if ($period === "semimonthly")
					$sss_contribution = $value['ee'] / 2;
				else
					$sss_contribution = $value['ee'];
			}
		}

	}
}

echo $sss_contribution;
#COMPUTE PHILHEALTH CONTRIBUTION

// dd($philhealth_table);
if($employee === true)
{
	foreach ($philhealth_table[0]['philhealth'] as $key => $value)
	{
		if ($value['salarylowerrange'] <= $basic_salary && $value['salaryupperrange'] >= $basic_salary)
		{
			if ($period === "semimonthly")
				$philhealth_contribution = $value['ee'] / 2;
			else
				$philhealth_contribution = $value['ee'];
		}


		if ($basic_salary < 8000)
		{
			if ($value['salarylowerrange'] === 8000.00)
			{	
				if ($period === "semimonthly")
					$philhealth_contribution = $value['ee'] / 2;
				else
					$philhealth_contribution = $value['ee'];
			}
		}


		if ($basic_salary > 35999.99)
		{
			if ($value['salaryupperrange'] === 35999.99)
			{	
				if ($period === "semimonthly")
					$philhealth_contribution = $value['ee'] / 2;
				else
					$philhealth_contribution = $value['ee'];
			}
		}

	}
}
echo "<br>";
echo  $philhealth_contribution;

#COMPUTE PAG-BIG  CONTRIBUTION

if (1500 >= $basic_salary)
	$pagibig_contribution = $MAX_MONTHLY_COMPENSATION * 0.01;
else 
	$pagibig_contribution = $MAX_MONTHLY_COMPENSATION * 0.02;

echo "<br>";
echo $pagibig_contribution;
#COMPUTE TAX DEDUCTION






$taxable_income = $basic_salary - ($philhealth_contribution + $sss_contribution + $pagibig_contribution);
$excess = 0;
echo "<br>";
echo "taxable_income:".$taxable_income;
// $taxable_income = 8558.00;
// dd($tax_table[0]['witholdingtax'][0]['table']);
// dd($tax_table[0]);
foreach ($tax_table[0]['witholdingtax'][1]['table'] as $key => $value) {
	
	if($civil_status === $value['status'] && $value['basicsalary'] <= $taxable_income)
	{
		echo "<br>";
		// echo $value['basicsalary'];
		$excess = (($taxable_income - $value['basicsalary']) * $value['percent']) / 100;
		$witholdingtax = $value['tax'] + $excess;
		break;
	}


};
echo "<br>";
echo "witholdingtax:".$witholdingtax;
