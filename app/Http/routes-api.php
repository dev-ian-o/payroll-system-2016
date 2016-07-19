<?php

Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('users', 'UserController');
    Route::resource('employees', 'EmployeeController');
    
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
   
});