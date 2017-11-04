<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_tracks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('downloads');
            $table->integer('user_id');
            $table->string('title');
			$table->string('artist');
			$table->string('cover');
            /*$table->integer('inspection')->default(0);
            
            $table->string('genre');
            $table->string('genre_alias');
            $table->integer('bpm');
            $table->string('key');
            
            $table->date('release');
            $table->string('preview');
            $table->string('track');*/
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
        Schema::drop('custom_tracks');
    }
}
