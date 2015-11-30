<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublicLogPrivilege extends Migration {

	public function up()
	{
		Schema::create('public.log_privilege', function(Blueprint $table)
		{
			$table->string('p_name');
			$table->string('p_admin');
			$table->string('p_action');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('public.log_privilege');
	}

}
