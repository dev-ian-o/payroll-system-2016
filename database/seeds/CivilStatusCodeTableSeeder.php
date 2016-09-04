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
       	DB::table('civil_status_codes')->truncate();

        CivilStatusCode::create(array(
            'id_json' => '1',
            'civil_status' => 'S',
            'civil_status_desc' => 'Single',
        ));

        CivilStatusCode::create(array(
            'id_json' => '2',
            'civil_status' => 'S1',
            'civil_status_desc' => 'Single w/ 1 dependent',
        ));

        CivilStatusCode::create(array(
            'id_json' => '3',
            'civil_status' => 'S2',
            'civil_status_desc' => 'Single w/ 2 dependents',
        ));

        CivilStatusCode::create(array(
            'id_json' => '4',
            'civil_status' => 'S3',
            'civil_status_desc' => 'Single w/ 3 dependents',
        ));

        CivilStatusCode::create(array(
            'id_json' => '5',
            'civil_status' => 'S4',
            'civil_status_desc' => 'Single w/ 4 dependents',
        ));


        CivilStatusCode::create(array(
            'id_json' => '1',
            'civil_status' => 'M',
            'civil_status_desc' => 'Married',
        ));

        CivilStatusCode::create(array(
            'id_json' => '2',
            'civil_status' => 'M1',
            'civil_status_desc' => 'Married w/ 1 dependent',
        ));

        CivilStatusCode::create(array(
            'id_json' => '3',
            'civil_status' => 'M2',
            'civil_status_desc' => 'Married w/ 2 dependents',
        ));

        CivilStatusCode::create(array(
            'id_json' => '4',
            'civil_status' => 'M3',
            'civil_status_desc' => 'Married w/ 3 dependents',
        ));

        CivilStatusCode::create(array(
            'id_json' => '5',
            'civil_status' => 'M4',
            'civil_status_desc' => 'Married w/ 4 dependents',
        ));


    }
}
