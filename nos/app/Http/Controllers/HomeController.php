<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$results = \DB::select('select * from stream.stream_1 where p_status = ? order by p_id desc ', ['available']);
		return view('home')->with('results', $results);
	}
	
	public function streamDetail($p_id, $p_cat)
	{
		if ($results = \DB::select('select * from stream.stream_'.$p_cat.' where p_id = ? and p_status = ?', [$p_id, 'available']))
		{
			$results_2 = \DB::select('select * from comment.comment_'.$p_id.' order by created_at desc limit 100 offset 0');
			return view('stream.detail')->with('results', $results)->with('results_2', $results_2)->with('p_id', $p_id)->with('p_cat', $p_cat);
		}
		else
		{
			$messages = 'The publication you meant is not a valid one.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function streamRecord()
	{
		$input = \Request::all();
		$date = new \DateTime;
		$name = \Auth::user()->name;
		
		$validator = \Validator::make(
			array	(
				'favor' => $input['favor'],
				'comment' => $input['comment']
  				),
    		array	(
				'favor' => 'required|max:100', 
				'comment' => 'required|max:1000'
    			)
			);
		
		if ($validator->fails())
		{
			return redirect('/stream/detail/'.$input['p_id'].'/'.$input['p_cat'])->withErrors($validator);
		}
		
		else
		{
			$results = \DB::select('select avatar from users_data where name = ?', [$name]);
			
			foreach ($results as $result)
			{
				$avatar = $result->avatar;
			}
			
			\DB::insert('insert into comment.comment_'.$input['p_id'].' (c_ouser, c_favor, c_comment, avatar, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$name, $input['favor'], $input['comment'], $avatar, $date, $date]);
			\DB::update('update stream.stream_'.$input['p_cat'].' set p_rating = (p_rating + 1) where p_id =?', [$input['p_id']]);
			// Insert notification system
			
			$n_message = 'Your publication is commented by '.$name;
			$n_link = '/stream/detail/'.$input['p_id'].'/'.$input['p_cat'];
			
			if ($input['p_ouser'] != 'anon' && $input['p_ouser'] != $name)
			{
				\DB::insert('insert into notification.inbox_'.$input['p_ouser'].' (n_message, n_link, n_sender, n_read, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$n_message, $n_link, $name, false, $date, $date]);
			}
			
			$messages = 'You comment is successfully submitted.';
			return redirect('/stream/detail/'.$input['p_id'].'/'.$input['p_cat'])->with('messages', $messages);
		}
		

	}

}
