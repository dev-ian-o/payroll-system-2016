<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserGroupsTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(HolidayTypeTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(EmployeeLeaveRecordTableSeeder::class);
        $this->call(LeaveTypeTableSeeder::class);
        $this->call(EmployeeLeaveRecordTableSeeder::class);
        $this->call(DailyTimeRecordTableSeeder::class);
        $this->call(CivilStatusCodeTableSeeder::class);
        $this->call(SalaryTableSeeder::class);
        $this->call(AnnouncementTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(HolidayTypeTableSeeder::class);
        $this->call(NightDiffSettingTableSeeder::class);
        $this->call(PayrollSettingTableSeeder::class);
        $this->call(PaySettingTableSeeder::class);

    }
}
