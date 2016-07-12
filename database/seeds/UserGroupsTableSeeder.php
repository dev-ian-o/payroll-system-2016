<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\UserGroup;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->truncate();

        // DB::table('user_groups')->insert([
        //     'groupname' => 'hr admin',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        UserGroup::create(array(
            'groupname' => 'hr admin'
        ));

        UserGroup::create(array(
            'groupname' => 'superuser'
        ));

    }
}
