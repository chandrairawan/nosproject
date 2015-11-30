<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StreamController extends Controller {

	public function index()
	{
		$data = \DB::table('users')->paginate(2);
		return \View::make('stream.stream', compact('data'));
	}
}
