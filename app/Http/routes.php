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
	Route::get('/employees', 			function(){ return View::make('admin.employees'); });
	

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