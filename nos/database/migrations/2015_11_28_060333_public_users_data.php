<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublicUsersData extends Migration {

	public function up()
	{
		Schema::create('users_data', function(Blueprint $table)
		{
			$table->string('name');
			$table->string('email')->unique();
			$table->string('avatar');
			$table->string('gender');
			$table->string('full_name');
			$table->string('bio');
			$table->string('department');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users_data');		
	}

}
