<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

use Illuminate\Http\Request;

class ProfileController extends Controller {


	public function view($name)
	{

		if ($results = \DB::select('select * from users_data where name = ?', [$name]))
		{
			return view('profile.view')->with('results', $results);
		}
		else
		{
			$messages = 'User is not found.';
			return redirect('/system/notification')->with('messages', $messages);
		}
		
	}

	public function edit()
	{

		$agent = new Agent();
		
		if ($agent->isMobile() or $agent->isTablet())
		{
			$messages = 'This feature is disabled for Mobile and Tablet devices. If you want to change profile information, do it later from allowed devices.';
			return redirect('/system/notification')->with('messages', $messages);
		}
		else
		{
			$name = \Auth::user()->name;
			$results = \DB::select('select * from users_data where name = ?', [$name]);
			return view('profile.edit')->with('results', $results);
		}
	}

	public function editRecord()
	{
		$name = \Auth::user()->name;
		
		if ((\Request::hasFile('avatar')) && (\Request::file('avatar')->isValid()))
		{
			$file = \Request::file('avatar');
			$input = \Request::all();
			$validator = \Validator::make(
				array	(
					'avatar' => $file, 
					'bio' => $input['bio']
  					),
    				array	(
					'avatar' => 'max:800|mimes:jpeg,jpg,gif', 
					'bio' => 'max:1000'
    					)
			);
			
			if ($validator->fails())
			{
				return redirect('/profile/edit')->withErrors($validator);
			}
			else
			{
				if ($input['avatar_path'] == '0')
				{
					$unique = str_random(20);
					$fileName = $unique;	
				}
				else
				{
					$fileName = $input['avatar_path'];
				}
					
				$destinationPath = 'database/pictures/avatars/';
				\Request::file('avatar')->move($destinationPath, $fileName);
				
				\DB::table('users_data')
					->where('name', $name)
					->update(['bio' => $input['bio'], 'avatar' => $fileName]);
					
				return redirect('/profile/'.$name);
			}
		}
		else
		{
			$input = \Request::all();
			$validator = \Validator::make(
				array	(
					'bio' => $input['bio']
  					),
    				array	(
					'bio' => 'max:1000'
    					)
			);

			if ($validator->fails())
			{
				return redirect('/profile/edit')->withErrors($validator);
			}
			else
			{
				\DB::table('users_data')
					->where('name', $name)
					->update(['bio' => $input['bio']]);
					
				return redirect('/profile/'.$name);
			}
		}
	}
	
	public function inbox()
	{
		$name = \Auth::user()->name;
		
		$results = \DB::select('select * from notification.inbox_'.$name.' order by created_at desc limit 70 offset 0');
		\DB::update('update notification.inbox_'.$name.' set n_read = true');
		
		return view('profile.inbox')->with('results', $results);
	}
}
