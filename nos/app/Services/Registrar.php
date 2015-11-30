<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		//All the email datas must be losercase
		$data['email'] = strtolower($data['email']);
		$data['name'] = strtolower($data['name']);

		return Validator::make($data, [
			'name' => 'required|max:50|min:8|alpha|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			
			'full_name' => 'required|max:100|min:8',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{		
		$data['email'] = strtolower($data['email']);
		$data['name'] = strtolower($data['name']);
		$date = new \DateTime;
		
		\DB::insert('insert into users_data (name, email, avatar, gender, full_name, bio, department, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$data['name'], $data['email'], '0', $data['gender'], $data['full_name'], '0', $data['department'], $date, $date]);
		
		\Schema::create('notification.inbox_'.$data['name'], function($table)
		{
			$table->text('n_message', 500);
			$table->string('n_link');
			$table->string('n_sender');
			$table->boolean('n_read');
			$table->timestamps();
		});	
		
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

}
