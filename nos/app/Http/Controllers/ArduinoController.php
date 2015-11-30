<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ArduinoController extends Controller {

	public function access($value, $client)
	{
		$date = new \DateTime;
		
		$read = false;
		
		\DB::insert('insert into public.arduino (v_val, v_cli, v_read, created_at, updated_at) values (?, ?, ?, ?, ?)',
		[$value, $client, $read, $date, $date]);
		return 'This is X553M Server, your value is: '.$value.', From client: '.$client;
	}
	
	public function access_2()
	{
		$date = new \DateTime;
		
		$read = false;
		
		$value = \Request::input('value');
		$client = \Request::input('client');
		
		\DB::insert('insert into public.arduino (v_val, v_cli, v_read, created_at, updated_at) values (?, ?, ?, ?, ?)',
		[$value, $client, $read, $date, $date]);
		return 'This is X553M Server, your value is: '.$value.', From client: '.$client;
	}
	
	public function view()
	{
		$results = \DB::select('select * from public.arduino where v_read = false order by created_at desc limit 50 offset 0');
		\DB::update('update public.arduino set v_read = true');
		return view('arduino.arduview')->with('results', $results);
	}
	
	public function view_2()
	{
		$results = \DB::select('select * from public.arduino order by created_at desc limit 400 offset 0');
		return view('arduino.arduview_2')->with('results', $results);
	}
	
	
}
