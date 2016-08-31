<?php

use Illuminate\Database\Seeder;
use App\Salary;

class SalaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('salaries')->truncate();
        //

        Salary::create(array(
            'id' => '1',
            'employee_id' => '1',
            'basic_pay'    => '15000',
            'sss_contribution' => '100',
            'pagibig_contribution' => '100',
            'philhealth_contribution' => '100',
        ));

        Salary::create(array(
            'id' => '2',
            'employee_id' => '2',
            'basic_pay'    => '12000',
            'sss_contribution' => '100',
            'pagibig_contribution' => '100',
            'philhealth_contribution' => '100',
        ));

        Salary::create(array(
            'id' => '3',
            'employee_id' => '3',
            'basic_pay'    => '12000',
            'sss_contribution' => '100',
            'pagibig_contribution' => '100',
            'philhealth_contribution' => '100',
        ));
    }
}
