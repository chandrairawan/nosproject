<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{
		$results = \DB::select('select app_terms, app_agree, app_policy from public.app_info where validity = true');
		return view('welcome')->with('results', $results);
	}
}
