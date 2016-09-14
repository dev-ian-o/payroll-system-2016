<?php

use Illuminate\Database\Seeder;
use App\DailyTimeRecord;
use Carbon\Carbon;

class DailyTimeRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_time_records')->truncate();
        $a = 1;
        $b = 32;
        $month = 8;
        $year = 2016;
        while($a < $b){
	        $date = Carbon::create($year, $month, $a, 0, 0, 0);
	        if(!$date->isWeekend()):
		        DailyTimeRecord::create(array(
		            'employee_id' => '1',
		            'time_in' => $date->format('Y-m-d') . ' 08:00:00',
		            'time_out' => $date->format('Y-m-d'). ' 17:00:00',
		            'created_at' => $date->format('Y-m-d'). ' 08:00:00',
		            'updated_at' => $date->format('Y-m-d'). '17:00:00'
		        ));
	        endif;
	        $a++;
	    }


    }
}
