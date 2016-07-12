P<?php

use Illuminate\Database\Seeder;
use App\HolidayType;

class HolidayTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holiday_types')->truncate();

        HolidayType::create(array(
        	'id' => '1',
            'holiday_type' => 'Regular Holiday',
        ));

        HolidayType::create(array(
        	'id' => '2',	
            'holiday_type' => 'Special Holiday',
        ));

    }
}
