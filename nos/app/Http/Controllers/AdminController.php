<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function admin()
	{
		if (\Auth::user()->admin == true)
		{
			return view('notification.admin');
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function moderation()
	{
		if (\Auth::user()->admin == true)
		{
			$results = \DB::select('select * from public.moderation order by p_id desc');
			return view('admin.moderation')->with('results', $results);
		}
		
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function suspend()
	{
		if (\Auth::user()->admin == true)
		{
			return view('admin.suspend');
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function unsuspend()
	{
		if (\Auth::user()->admin == true)
		{
			return view('admin.unsuspend');
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function privilege()
	{
		if (\Auth::user()->admin == true)
		{
			return view('admin.privilege');
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function application()
	{
		if (\Auth::user()->admin == true)
		{
			$results = \DB::select('select * from public.app_info where validity = true');
			return view('admin.application')->with('results', $results);
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	//------------------------------------RECORD SECTION-------------------------------------------
	
	public function moderationRecord($p_id, $status)
	{
		if (\Auth::user()->admin == true)
		{
			if (\DB::select('select 1 from moderation where p_id = ?', [$p_id]))
			{
				$p_admin = \Auth::user()->name;
				$date = new \DateTime;
				
				$results = \DB::select('select * from moderation where p_id = ?', [$p_id]);	
				
				if ($status == 'approve')
				{
					foreach ($results as $result)
					{
						\DB::insert('insert into public.log_moderation (p_id, p_cat, p_admin, p_status, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$p_id, $result->p_cat, $p_admin, 'available', $date, $date]);
						\DB::insert('insert into stream.stream_'.$result->p_cat.' (p_id, p_cat, p_ouser, p_title, p_caption, p_imgurl, p_status, p_reported, p_rating, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
						[$result->p_id, $result->p_cat, $result->p_ouser, $result->p_title, $result->p_caption, $result->p_imgurl, 'available', $result->p_reported, $result->p_rating, $result->created_at, $date]);
						\DB::delete('delete from public.moderation where p_id = ?', [$p_id]);
						
						// Membuat tabel baru.
						\Schema::create('comment.comment_'.$result->p_id, function($table)
						{
							$table->string('c_ouser', 120);
							$table->string('c_favor');
							$table->text('c_comment', 1000);
							$table->string('avatar');
							$table->timestamps();
						});					
					}
					
					$messages = 'The publication has been approved.';
					return redirect('/admin/moderation')->with('messages', $messages);
				}
				
				elseif ($status == 'deny')
				{
					foreach ($results as $result)
					{
						\DB::insert('insert into public.log_moderation (p_id, p_cat, p_admin, p_status, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$p_id, $result->p_cat, $p_admin, 'denied', $date, $date]);
						\DB::insert('insert into stream.stream_'.$result->p_cat.' (p_id, p_cat, p_ouser, p_title, p_caption, p_imgurl, p_status, p_reported, p_rating, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
						[$result->p_id, $result->p_cat, $result->p_ouser, $result->p_title, $result->p_caption, $result->p_imgurl, 'denied', $result->p_reported, $result->p_rating, $result->created_at, $date]);
						\DB::delete('delete from public.moderation where p_id = ?', [$p_id]);
					}
					
					$messages = 'The publication has been denied.';
					return redirect('/admin/moderation')->with('messages', $messages);
				}
				
				else
				{
					$messages = 'The processing status is not valid, only "approve" or "deny".';
					return redirect('/admin/moderation')->with('messages', $messages);	
				}
			}
			
			else
			{
				$messages = 'There is no such publication, or publication has been processed.';
				return redirect('/admin/moderation')->with('messages', $messages);				
			}
		}
		
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);		
		}
		
	}
	
	public function suspendRecord()
	{
		if (\Auth::user()->admin == true)
		{
			$name = \Request::input('name');
			
			if (\DB::select('select 1 from users where name = ? and admin = false and suspend = false', [$name]))
			{
				$date = new \DateTime;
				$admin = \Auth::user()->name;
				$action = 'Suspend';
				\DB::update('update users set suspend = true where name = ?', [$name]);
				\DB::insert('insert into log_suspension (p_name, p_admin, p_action, created_at, updated_at) values (?, ?, ?, ?, ?)', [$name, $admin, $action, $date, $date]);
				
				$messages = 'Success. User is suspended.';
				return redirect('/admin/suspend')->with('messages', $messages);
			}
			
			else
			{
				$messages = 'There is no such username or the user you meant is an admin which not eligible for suspension. Make sure of it.';
				return redirect('/admin/suspend')->with('messages', $messages);	
			}
		}
		
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}		
	}
	
	public function unsuspendRecord()
	{
		if (\Auth::user()->admin == true)
		{
			$name = \Request::input('name');
			
			if (\DB::select('select 1 from users where name = ? and admin = false and suspend = true', [$name]))
			{
				$date = new \DateTime;
				$admin = \Auth::user()->name;
				$action = 'Unsuspend';
				\DB::update('update users set suspend = false where name = ?', [$name]);
				\DB::insert('insert into log_suspension (p_name, p_admin, p_action, created_at, updated_at) values (?, ?, ?, ?, ?)', [$name, $admin, $action, $date, $date]);
				
				$messages = 'Success. User is unsuspended.';
				return redirect('/admin/unsuspend')->with('messages', $messages);
			}
			
			else
			{
				$messages = 'There is no such username or the user you meant is an admin which not eligible for unsuspension. Make sure of it.';
				return redirect('/admin/unsuspend')->with('messages', $messages);	
			}
		}
		
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}		
	}
	
	public function privilegeRecord()
	{
		if (\Auth::user()->admin == true)
		{
			$name = \Request::input('name');
			if (\DB::select('select 1 from users where name = ? and admin = false and suspend = false', [$name]))
			{
				$date = new \DateTime;
				$admin = \Auth::user()->name;
				$action = 'Give Admin Privilege';
				
				\DB::update('update users set admin = true where name = ?', [$name]);
				\DB::insert('insert into log_privilege (p_name, p_admin, p_action, created_at, updated_at) values (?, ?, ?, ?, ?)', [$name, $admin, $action, $date, $date]);
				
				$messages = 'Success. User is now and admin.';
				return redirect('/admin/privilege')->with('messages', $messages);
			}
			else
			{
				$messages = 'There is no such username or the user you meant is an admin which not eligible for this privilege or already have. Make sure of it.';
				return redirect('/admin/privilege')->with('messages', $messages);
			}
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
	public function applicationRecord()
	{
		if (\Auth::user()->admin == true)
		{
			$name = \Auth::user()->name;
			$input = \Request::all();
			$date = new \DateTime;
			
			// No validation for Admins
			
			\DB::table('public.app_info')
				->where('validity', true)
				->update([	'app_version' => $input['app_version'],
							'app_info' => $input['app_info'],
							'app_domain' => $input['app_domain'],
							'app_email' => $input['app_email'],
							'app_terms' => $input['app_terms'],
							'app_agree' => $input['app_agree'],
							'app_policy' => $input['app_policy'],
							'app_notification' => $input['app_notification'],
							'updated_at' => $date]
						);
			
			$action = 'Submitting from Application Information State form. Probably changed.';
			\DB::insert('insert into log_application (p_admin, p_action, created_at, updated_at) values (?, ?, ?, ?)', [$name, $action, $date, $date]);
			
			$messages = 'Application Informatin State successfully changed.';
			return redirect('/admin/application')->with('messages', $messages);
		}
		else
		{
			$messages = 'You are not an admin. No rights to access administration area.';
			return redirect('/system/notification')->with('messages', $messages);
		}
	}
	
}
