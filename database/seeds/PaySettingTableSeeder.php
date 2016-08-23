<?php

use Illuminate\Database\Seeder;
use App\PaySetting;


class PaySettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pay_settings')->truncate();
        //

        PaySetting::create(array(
            'pay_type' => 'Regular Workday',
            'first_nine_hrs_pay' => '100',
            'excess_of_nine_hrs_pay'    => '150',
        ));
        PaySetting::create(array(
            'pay_type' => 'Rest Day',
            'first_nine_hrs_pay' => '150',
            'excess_of_nine_hrs_pay'    => '195',
        ));
        PaySetting::create(array(
            'pay_type' => 'Special Holiday',
            'first_nine_hrs_pay' => '50',
            'excess_of_nine_hrs_pay'    => '195',
        ));
        PaySetting::create(array(
            'pay_type' => 'Special Holiday on Rest Day',
            'first_nine_hrs_pay' => '160',
            'excess_of_nine_hrs_pay'    => '198',
        ));
        PaySetting::create(array(
            'pay_type' => 'Regular Holiday',
            'first_nine_hrs_pay' => '100',
            'excess_of_nine_hrs_pay'    => '260',
        ));
        PaySetting::create(array(
            'pay_type' => 'Regular Holiday on Rest Day',
            'first_nine_hrs_pay' => '260',
            'excess_of_nine_hrs_pay'    => '338',
        ));

    }
}

