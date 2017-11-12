<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoundcloudTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soundcloud_tracks', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('downloads');
				$table->integer('user_id')->nullable();
				$table->string('email');
				$table->string('title');
				$table->integer('inspection')->default(0);
				$table->string('artist');
				$table->string('genre');
				$table->string('genre_alias');
				$table->string('cover');
				$table->date('release');
				$table->string('link');
				$table->string('track')->nullable();
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
        Schema::drop('soundcloud_tracks');
    }
}
