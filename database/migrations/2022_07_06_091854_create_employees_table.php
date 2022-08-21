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
            $table->string('first_name');
            $table->string('second_name');
            $table->string('family_name');
            $table->string('id_card');
            $table->text('address');
            $table->text('mobile');
            $table->string('gender', 1);
            $table->string('status', 1);
            $table->integer('family_count')->nullable();
            $table->string('job_title');
            $table->date('date_of_birth');
            $table->date('date_of_employment');
            $table->string('office_tel')->nullable();
            $table->string('nationality');
            $table->integer('salary');
            $table->string('bank_account')->nullable();
            $table->unique('account_no');
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
