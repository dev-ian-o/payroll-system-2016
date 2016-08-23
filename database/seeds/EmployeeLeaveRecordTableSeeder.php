<?php

use Illuminate\Database\Seeder;
use App\EmployeeLeaveRecord;

class EmployeeLeaveRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_leave_records')->truncate();

        EmployeeLeaveRecord::create(array(
            'employee_id' => '1',
            'leave_type_id' => '1',
            'date_from' => '2016-08-01',
            'date_to' => '2016-08-30',
        ));

        EmployeeLeaveRecord::create(array(
            'employee_id' => '2',
            'leave_type_id' => '1',
            'date_from' => '2016-08-01',
            'date_to' => '2016-08-30',
        ));
    }
}
