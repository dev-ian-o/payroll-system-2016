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

use App\User;
use App\Employee;



include 'routes-api.php';


Route::get('/', function () {
    return view('index');
});


Route::group(array('prefix' => 'admin','middleware' => 'auth'), function()
{

	Route::get('/', 			function(){ return View::make('admin.index'); });
	Route::get('/index', 			function(){ return View::make('admin.index'); });
	Route::get('/dashboard', 			function(){ return View::make('admin.index'); });
	Route::get('/users', 			function(){ return View::make('admin.users'); });
    Route::get('/employees',            function(){ return View::make('admin.employees'); });
    Route::get('/settings',             function(){ return View::make('admin.settings'); });
	Route::get('/announcements', 			function(){ return View::make('admin.announcements'); });
	

});



Route::get('/login', function()
{
	if(Auth::check())
        return View::make('admin.index');
    else
        return View::make('login');
});


Route::match(array('GET', 'POST'), '/logout', function()
{
	Auth::logout();
    return Redirect::to('login');
});


Route::get('/computation', function()
{
	return View::make('computation');
});


Route::post('/api/v1/auth/confirm', function()
{
	$userdata = array(
        'username' => Request::input('username'),
        'password' => Request::input('password')
    );

    if(Auth::attempt($userdata)) 
        return response()->json(array('success'=> true));
    if(Auth::attempt($userdata)) 
        return response()->json(array('success'=> false));
});


Route::get('/admin/employees/{employee_no}', function($employee_no)
{
    
    if(Employee::where('employee_no', '=', $employee_no)->exists()){
        return View::make('admin.employees-profile')->with('employee_no',$employee_no);
    }
    else{
        return Redirect::to('/admin/employees');
    }
});