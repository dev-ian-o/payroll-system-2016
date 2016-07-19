<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->truncate();

        Employee::create(array(
            'employee_no' => '000000001',
            'firstname' => 'firstname1',
            'lastname'    => 'lastname1',
            'middlename' => 'middlename1',
            'birthdate' => '1990-05-01',
            'address' => 'address1',
            'city' => 'city1',
            'province' => 'province1',
            'zip_code' => 'zip_code1',
            'salary_id' => '1',
            'civil_status_code_id' => '1',
            'employee_leave_count_id' => '1',
            'image' => 'http://somepath/',
        ));

        Employee::create(array(
            'employee_no' => '000000002',
            'firstname' => 'firstname2',
            'lastname'    => 'lastname2',
            'middlename' => 'middlename2',
            'birthdate' => '1990-05-01',
            'address' => 'address2',
            'city' => 'city2',
            'province' => 'province2',
            'zip_code' => 'zip_code2',
            'salary_id' => '2',
            'civil_status_code_id' => '2',
            'employee_leave_count_id' => '2',
            'image' => 'http://somepath/',
        ));

        Employee::create(array(
            'employee_no' => '000000003',
            'firstname' => 'firstname3',
            'lastname'    => 'lastname3',
            'middlename' => 'middlename3',
            'birthdate' => '1990-05-01',
            'address' => 'address3',
            'city' => 'city3',
            'province' => 'province3',
            'zip_code' => 'zip_code3',
            'salary_id' => '3',
            'civil_status_code_id' => '3',
            'employee_leave_count_id' => '3',
            'image' => 'http://somepath/',
        ));


    }
}
