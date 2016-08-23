<?php

Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('users', 'UserController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('salaries', 'SalaryController');
    Route::resource('daily_time_records', 'DailyTimeRecordController');
    Route::resource('payroll_settings', 'PayrollSettingController');
    Route::resource('announcements', 'AnnouncementController');
    Route::resource('leave_types', 'LeaveTypeController');
    Route::resource('holidays', 'HolidayController');
    Route::resource('pay_settings', 'PaySettingController');
    Route::resource('night_diff_settings', 'NightDiffSettingController');
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