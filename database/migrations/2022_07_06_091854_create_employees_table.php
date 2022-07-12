<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('account_no')->index();
            $table->string('slug')->index();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('family_name');
            $table->string('gender', 1);
            $table->string('job_title');
            $table->date('date_of_birth');
            $table->date('date_of_employment');
            $table->string('office_tel');
            $table->string('nationality');
            $table->integer('salary');
            $table->string('bank_account');
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
        Schema::dropIfExists('employees');
    }
}
