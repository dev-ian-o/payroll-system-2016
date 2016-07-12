<?php

use Illuminate\Database\Seeder;
use App\Holiday;

class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holidays')->truncate();

        Holiday::create(array(
            'holiday' => 'Labor Day',
            'date' => '2016-07-06',
            'holiday_type_id' => '1'
        ));

        Holiday::create(array(
            'holiday' => 'National Elections',
            'date' => '2016-05-09',
            'holiday_type_id' => '2'
        ));

        Holiday::create(array(
            'holiday' => 'Independence Day',
            'date' => '2016-06-12',
            'holiday_type_id' => '1'
        ));

    }
}
