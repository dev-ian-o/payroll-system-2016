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

// use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::group(array('prefix' => 'admin','middleware' => 'auth'), function()
{

	Route::get('/', 			function(){ return View::make('admin.index'); });
	

});



Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('users', 'UserController');
    
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

Route::post('/api/v1/auth', function()
{
	$userdata = array(
        'username' => Request::input('username'),
        'password' => Request::input('password')
    );

    if(Auth::attempt($userdata)) 
        return Redirect::to('admin');
    else
        return Redirect::back()->withErrors(['Invalid username or password']);
        // return View::make('login');

});