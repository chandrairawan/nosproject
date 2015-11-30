<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublicLogModeration extends Migration {

	public function up()
	{
		Schema::create('public.log_moderation', function(Blueprint $table)
		{
			$table->integer('p_id');
			$table->integer('p_cat');
			$table->string('p_admin');
			$table->string('p_status');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('public.log_moderation');
	}

}
