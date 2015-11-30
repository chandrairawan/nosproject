<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StreamStream6 extends Migration {

	public function up()
	{
		Schema::create('stream.stream_6', function(Blueprint $table)
		{
			$table->increments('p_id');
			$table->integer('p_cat');
			$table->string('p_ouser', 120);
			$table->text('p_title');
			$table->text('p_caption');
			$table->string('p_imgurl', 500);
			$table->string('p_status', 30);
			$table->integer('p_reported');
			$table->integer('p_rating');
			$table->timestamps();
		});	
	}

	public function down()
	{
		Schema::drop('stream.stream_6');	
	}

}
