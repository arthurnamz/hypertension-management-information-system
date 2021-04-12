<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hospitals', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2021_03_03_000000_create_tbl_hospitals_table.php
            $table->string('name');
            $table->string('location');
=======
            $table->string('album_title');
            $table->string('cover_picture');
            $table->enum('for_sale', ['no', 'yes']);
            $table->double('price');
            $table->string('download');
            $table->date('released_time');
>>>>>>> 3d5c7a1e1450b75a69de16b14572ce597300cb78:database/migrations/2020_09_04_162338_create_albums_table.php
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
        Schema::dropIfExists('tbl_hospitals');
    }
}
