<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

use Illuminate\Http\Request;

class PublicationController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create()
	{
		$agent = new Agent();
		
		if ($agent->isMobile() or $agent->isTablet())
		{
			$messages = 'This feature is disabled for Mobile and Tablet devices. If you want to make a publication do it later from allowed devices.';
			return redirect('/system/notification')->with('messages', $messages);
		}
		else
		{
			if (\Auth::user()->suspend == true)
			{
				$messages = 'You are now suspended. Suspended users cannot publish contents.';
				return redirect('/system/notification')->with('messages', $messages);
			}
			
			else
			{
				return view('publication.create');
			}
		}
	}

	public function record()
	{
		if ((\Request::hasFile('image')) && (\Request::file('image')->isValid()) && (\Auth::user()->suspend == false))
		{

			$file = \Request::file('image');
			$input = \Request::all();
			$date = new \DateTime;
			
			if (isset($input['anon']))
			{
				$name = 'anon';
			}
			else
			{
				$name = \Auth::user()->name;
			}

			$validator = \Validator::make(
				array	(
					'image' => $file, 
					'category' => $input['category'], 
					'title' => $input['title'], 
					'caption' => $input['caption']
  					),
    				array	(
					'image' => 'required|max:1200|mimes:jpeg,jpg,gif', 
					'category' => 'required', 
					'title' => 'required|max:120', 
					'caption' => 'required|max:360'
    					)
			);
			
			if ($validator->fails())
			{
				return redirect('/publish')->withErrors($validator);
			}
			else
			{	
				$unique = str_random(10);
				$fileName = $unique;
				$destinationPath = 'database/pictures/stream_'.$input['category'].'/';
				\Request::file('image')->move($destinationPath, $fileName);				
			
				\DB::insert('insert into public.moderation (p_cat, p_ouser, p_title, p_caption, p_imgurl, p_status, p_reported, p_rating, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$input['category'], $name, $input['title'], $input['caption'], $unique, 'available', 0, 0, $date, $date]);

				$messages = 'Your content has been succesfully submitted. Going on moderation process.';
				return redirect('/system/notification')->with('messages', $messages);
			}
		}
		else
		{
			$messages = 'Your content data is invalid. The process is aborted.';
			return redirect('/system/notification')->with('messages', $messages);
		}	
	}
}
