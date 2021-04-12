<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('namartists_id');
            $table->foreign('namartists_id')->references('id')->on('namartists')->onDelete('cascade');
            $table->unsignedBigInteger('albums_id');
            $table->foreign('albums_id')->references('id')->on('albums')->onDelete('cascade');
            $table->string('song_name');
            $table->integer('downloads');
            $table->integer('streams');
            $table->string('image');
            $table->string('song_file');
            $table->string('genres');
            $table->enum('for_sale', ['no', 'yes']);
            $table->double('price');
            $table->time('duration');
            $table->date('released_time');
            $table->date('date_produced');
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
        Schema::dropIfExists('music');
    }
}
