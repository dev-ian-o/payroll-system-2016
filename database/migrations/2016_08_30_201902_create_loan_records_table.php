<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('loan_status');
            $table->string('months_of_payment');
            $table->double('loan_balance');
            $table->double('loan_paid');
            $table->double('loan_total');
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
        Schema::drop('loan_records');
    }
}
