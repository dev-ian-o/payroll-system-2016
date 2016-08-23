<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmployeeLeaveRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_leave_records', function (Blueprint $table) {
            
            $table->renameColumn('date', 'date_from');

        });
        Schema::table('employee_leave_records', function (Blueprint $table) {
            
            $table->datetime('date_to')->after('date_from');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_leave_records', function (Blueprint $table) {
            //
        });
    }
}
