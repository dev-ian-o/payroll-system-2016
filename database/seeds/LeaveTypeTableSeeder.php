<?php

use Illuminate\Database\Seeder;
use App\LeaveType;
use App\EmployeeLeaveCount;
use App\Employee;

class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->truncate();
        DB::table('employee_leave_counts')->truncate();

        LeaveType::create(array(
        	'id' => '1',
            'leave_type' => 'Sick Leave',
            'default_no_per_employee' => '15',
        ));

        LeaveType::create(array(
        	'id' => '2',	
            'leave_type' => 'Vacation Leave',
            'default_no_per_employee' => '15',
        ));

        LeaveType::create(array(
        	'id' => '3',	
            'leave_type' => 'Leave without pay',
            'default_no_per_employee' => '0',
        ));


        foreach (Employee::where('deleted_at',null)->get() as $key => $value){
                EmployeeLeaveCount::create(array(
                    'employee_id' => $value->id,
                    'leave_type_id' => 1,
                    'total_leave_count' => 15,
                    'actual_leave_count' => 15,
                ));
                EmployeeLeaveCount::create(array(
                    'employee_id' => $value->id,
                    'leave_type_id' => 2,
                    'total_leave_count' => 15,
                    'actual_leave_count' => 15,
                ));
                EmployeeLeaveCount::create(array(
                    'employee_id' => $value->id,
                    'leave_type_id' => 3,
                    'total_leave_count' => 0,
                    'actual_leave_count' => 0,
                ));
                
        }

    }
}
