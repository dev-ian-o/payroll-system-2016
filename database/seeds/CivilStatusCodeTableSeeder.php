<?php

use Illuminate\Database\Seeder;
use App\CivilStatusCode;
class CivilStatusCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('holiday_types')->truncate();

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'S',
            'civil_status_desc' => 'single',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'S1',
            'civil_status_desc' => 'Single w/ 1 dependent',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'S2',
            'civil_status_desc' => 'Single w/ 2 dependent',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'S3',
            'civil_status_desc' => 'Single w/ 3 dependent',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'S4',
            'civil_status_desc' => 'Single w/ 4 dependent',
        ));


        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'M',
            'civil_status_desc' => 'Married',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'M1',
            'civil_status_desc' => 'Married w/ 1 dependent',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'M2',
            'civil_status_desc' => 'Married w/ 2 dependent',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'M3',
            'civil_status_desc' => 'Married w/ 3 dependent',
        ));

        CivilStatusCode::create(array(
        	'id' => '1',
            'civil_status' => 'M4',
            'civil_status_desc' => 'Married w/ 4 dependent',
        ));


    }
}
