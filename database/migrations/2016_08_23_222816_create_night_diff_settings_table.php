<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNightDiffSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('night_diff_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->time('nd_shift_time_start');
            $table->time('nd_shift_time_end');
            $table->string('nd_pay');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('night_diff_settings');
    }
}
