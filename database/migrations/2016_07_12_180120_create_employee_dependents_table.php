<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_dependents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('lastname');
            $table->string('firstname');
            $table->date('birthdate');
            $table->string('relationship_with_employee');
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
        Schema::drop('employee_dependents');
    }
}
