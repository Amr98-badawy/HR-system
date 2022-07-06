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
            $table->string('name');
            $table->string('gender', 1);
            $table->string('title');
            $table->dateTime('date_of_birth');
            $table->dateTime('date_of_employment');
            $table->string('office_tel');
            $table->string('nationality');
            $table->string('salary');
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
