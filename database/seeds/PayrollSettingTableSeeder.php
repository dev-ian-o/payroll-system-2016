<?php

use Illuminate\Database\Seeder;
use App\PayrollSetting;


class PayrollSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payroll_settings')->truncate();

        PayrollSetting::create(array(
            'daily_start_shift' => '08:00',
            'daily_end_shift' => '17:00',
            'cutoff_dates' => json_encode(array("_1"=>"10","_2"=>"20")),
        ));
   
    }
}
