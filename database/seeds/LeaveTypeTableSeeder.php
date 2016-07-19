<?php

use Illuminate\Database\Seeder;
use App\LeaveType;

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

        LeaveType::create(array(
        	'id' => '1',
            'leave_type' => 'Sick Leave',
        ));

        LeaveType::create(array(
        	'id' => '2',	
            'leave_type' => 'Vacation Leave',
        ));

        LeaveType::create(array(
        	'id' => '3',	
            'leave_type' => 'Leave without pay',
        ));
    }
}
