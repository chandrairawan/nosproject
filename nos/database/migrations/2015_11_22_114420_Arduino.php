<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Arduino extends Migration {

	public function up()
	{
		Schema::create('public.arduino', function(Blueprint $table)
		{
			$table->increments('v_id');
			$table->integer('v_val');
			$table->string('v_cli');
			$table->boolean('v_read');
			$table->timestamps();
		});	
	}

	public function down()
	{
		Schema::drop('public.arduino');
	}

}
