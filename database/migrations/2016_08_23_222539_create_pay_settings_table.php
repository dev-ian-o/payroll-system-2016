<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pay_type');
            $table->string('first_nine_hrs_pay');
            $table->string('excess_of_nine_hrs_pay');
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
        Schema::drop('pay_settings');
    }
}
