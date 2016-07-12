<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_no')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->date('birthdate');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code');
            $table->integer('salary_id')->unsigned();
            $table->integer('civil_status_code_id')->unsigned();
            $table->integer('employee_leave_id')->unsigned();
            $table->integer('employee_leave_count_id')->unsigned();
            $table->text('image');
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
        Schema::drop('employees');
    }
}
