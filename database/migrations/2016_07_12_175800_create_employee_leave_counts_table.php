<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLeaveCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('leave_type_id');
            $table->double('total_leave_count');
            $table->double('actual_leave_count');
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
        Schema::drop('employee_leave_counts');
    }
}
