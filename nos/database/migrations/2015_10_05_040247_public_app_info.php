<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublicAppInfo extends Migration {

	public function up()
	{
		$date = new \DateTime;
		
		Schema::create('public.app_info', function(Blueprint $table)
		{
			$table->boolean('validity')->default(0);
			$table->string('app_version');
			$table->string('app_info');
			$table->string('app_domain');
			$table->string('app_email');
			$table->text('app_terms');
			$table->text('app_agree');
			$table->text('app_policy');
			$table->string('app_notification');
			$table->timestamps();
		});
		
		DB::insert('insert into public.app_info (validity, app_version, app_info, app_domain, app_email, app_terms, app_agree, app_policy, app_notification, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
		[
			true,
			'NOS Prototype',
			'NOS Software is still on development',
			'192.168.0.14, 192.168.43.151, development.app',
			'nos@nosproject.com',
			'App terms is to be defined',
			'App user agreement is to be defined',
			'App policy is to be defined',
			'App is not for production, still prototype and is on the testing phase',
			$date,
			$date
		]);
	}

	public function down()
	{
		Schema::drop('public.app_info');
	}

}
