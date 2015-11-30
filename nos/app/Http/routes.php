<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// General area
Route::get('/', 'WelcomeController@index');
Route::get('stream', 'StreamController@index');
Route::get('home', 'HomeController@index');

// Publication details
Route::get('stream/detail/{p_id}/{p_cat}', 'HomeController@streamDetail');
Route::get('stream/detail', function()
{
    return redirect('home');
});
Route::post('stream/detail', 'HomeController@streamRecord');


// Publication
Route::get('publish', 'PublicationController@create');
Route::post('publish/record', 'PublicationController@record');

// System notification
Route::get('system/notification', 'NotificationController@index');

// Administration
Route::get('admin/notification', 'AdminController@admin');

Route::get('admin/moderation', 'AdminController@moderation');
Route::get('admin/moderation/{p_id}/{status}', 'AdminController@moderationRecord');

Route::get('admin/suspend', 'AdminController@suspend');
Route::post('admin/suspend', 'AdminController@suspendRecord');

Route::get('admin/unsuspend', 'AdminController@unsuspend');
Route::post('admin/unsuspend', 'AdminController@unsuspendRecord');

Route::get('admin/privilege', 'AdminController@privilege');
Route::post('admin/privilege', 'AdminController@privilegeRecord');

Route::get('admin/report', 'AdminController@report');
Route::get('admin/log', 'AdminController@log');
Route::get('admin/command', 'AdminController@command');

Route::get('admin/application', 'AdminController@application');
Route::post('admin/application', 'AdminController@applicationRecord');

// Authentication
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// User profile
Route::get('profile/inbox', 'ProfileController@inbox');
Route::get('profile/edit', 'ProfileController@edit');
Route::post('profile/edit', 'ProfileController@editRecord');
Route::get('profile/{name}', 'ProfileController@view');


//Route::get('arduino/{value}/{client}', 'ArduinoController@access');
//Route::get('arduview', 'ArduinoController@view');
//Route::get('arduview2', 'ArduinoController@view_2');
//Route::post('arduino', 'ArduinoController@access_2');

