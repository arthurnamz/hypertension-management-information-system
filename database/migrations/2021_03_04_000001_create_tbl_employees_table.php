<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('hospital_id')->references('id')->on('tbl_hospitals')->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->enum('role', ['administrator_moh','administrator_site','doctor','nurse','employee_moh','clinician','lab_tech']);
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->string('village');
            $table->string('T_A');
            $table->string('district');
            $table->string('next_of_kin')->nullable();
            $table->integer('nok_phone_number')->nullable();
            $table->string('national_id');
            $table->enum('disability', ['yes', 'no']);
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
        Schema::dropIfExists('tbl_employees');
    }
}
