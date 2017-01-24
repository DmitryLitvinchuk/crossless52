<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadedTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloaded_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('track_id');
            $table->string('title');
            $table->string('artist');
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
        Schema::drop('downloaded_tracks');
    }
}
