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
    Route::get('/announcements',            function(){ return View::make('admin.announcements'); });
    Route::get('/holidays',            function(){ return View::make('admin.holidays'); });
    Route::get('/leaves',           function(){ return View::make('admin.leaves'); });
    Route::get('/timesheet',            function(){ return View::make('admin.timesheet'); });
	Route::get('/payroll', 			function(){ return View::make('admin.payroll'); });
	

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




Route::post('/admin/timesheet', function(Request $request)
{

    $file = Request::file('file');
    $content = File::get($file->getRealPath());


    echo "<pre>";
    $content = explode(PHP_EOL, $content);
    $length_content = count($content);
     
    DB::table('tmp_dtrs')->truncate();

    foreach ($content as $key2 => $value1) {

        if($key2 != 0 && $key2 != $length_content - 1){
            $content = explode("\t", $value1);
           

            App\TmpDtr::create(array(
                'employee_no' => $content[2],
                'mode' => $content[5],
                'datetime'    => $content[6],
            ));
        
        }
    }
    // $oldest = App\TmpDtr::where('')
    


     // dd($content);

    $oldest = App\TmpDtr::orderBy('datetime','ASC')->first();
    $latest = App\TmpDtr::orderBy('datetime','DESC')->first();

    $oldest_datetime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oldest->datetime )->format('Y-m-d');     
    $latest_datetime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $latest->datetime )->format('Y-m-d');     
    
    $oldest_datetime = strtotime($oldest_datetime . " 12:00");
    $latest_datetime = strtotime($latest_datetime . " 12:00");
    

    

    foreach (App\Employee::where('deleted_at', '=', NULL)    
        ->get() as $key => $value) {
        # code...
        for ( $i = $oldest_datetime; $i <= $latest_datetime; $i = $i + 86400 ) {
          $thisDate = date( 'Y-m-d', $i );
          // echo $value->employee_no;
          // echo $thisDate;
          $time_in = App\TmpDtr::where('employee_no','=',$value->employee_no)
                        ->whereDate('datetime','=',$thisDate)
                        ->where('mode','=','0')
                        ->orderBy('datetime','ASC')
                        ->first();
          $time_out = App\TmpDtr::where('employee_no','=',$value->employee_no)
                        ->whereDate('datetime','=',$thisDate)
                        ->where('mode','=',3)
                        ->orderBy('datetime','DESC')
                        ->first();

          if(! empty($time_in)) { $time_in = $time_in->datetime; }
          if(! empty($time_out)) { $time_out = $time_out->datetime; } else { $time_out = NULL; }
          if(! empty($time_in))
          {

                $employee = App\Employee::where('employee_no', '=', $value->employee_no)
                        ->get();
                $employee_id = $employee[0]->id;
                $check_if_exist = App\DailyTimeRecord::where('time_in','=',$time_in)
                            ->where('time_out','=',$time_out)
                            ->where('employee_id','=',$employee_id)
                            ->exists();
                            // print_r($check_if_exist);
                  if( ! $check_if_exist )
                  {
                      echo "<br>";        
                      echo "++++++++++";

                      echo $value->employee_no;
                      echo "<br>";
                      echo $time_in;
                      echo "<br>";
                      echo $time_out;
                     App\DailyTimeRecord::create(array(
                        'employee_id' => $employee_id,
                        'time_in' => $time_in,
                        'time_out'    => $time_out,
                        'created_at'    => $time_in,
                        'updated_at'    => $time_in,
                      )); 

                  }  
                 
          }


        }
    }




});

Route::get('/admin/timeshet', function(Request $request)
{

    // $file = Request::file('file');
    // $content = File::get($file->getRealPath());

// 
    echo "<pre>";
    // $content = explode(PHP_EOL, $content);
    // $length_content = count($content);
     
    // DB::table('tmp_dtrs')->truncate();

    // foreach ($content as $key2 => $value1) {

    //     if($key2 != 0 && $key2 != $length_content - 1){
    //         $content = explode("\t", $value1);
           

    //         App\TmpDtr::create(array(
    //             'employee_no' => $content[2],
    //             'mode' => $content[5],
    //             'datetime'    => $content[6],
    //         ));
        
    //     }
    // }
    
     // dd($content);
});