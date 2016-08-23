<?php

use Illuminate\Database\Seeder;
use App\NightDiffSetting;

class NightDiffSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('night_diff_settings')->truncate();
        //

        NightDiffSetting::create(array(
            'nd_pay' => '30',
            'nd_shift_time_start' => '21:00:00',
            'nd_shift_time_end'    => '6:00:00',
        ));
    }
}
