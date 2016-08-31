<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DailyTimeRecord;
use App\Employee;
use Validator;
use Carbon\Carbon;

class DailyTimeRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily_time_records = DailyTimeRecord::where('daily_time_records.deleted_at', '=', NULL)
        ->leftJoin('employees', 'employees.id', '=', 'daily_time_records.employee_id')
        ->select('*','daily_time_records.id','daily_time_records.deleted_at','daily_time_records.created_at','daily_time_records.updated_at')
        ->get();

        // echo date('21');
        $date_now = Carbon::now(new \DateTimeZone('Asia/Manila'));

        $employee_no = "000000001";
        $id = Employee::where('employee_no','=',$employee_no)->pluck('id');
         // echo date("Y/m/d H:i:s");
        $check_if_time_in_today = DailyTimeRecord::where('employee_id','=',$id)
            ->where( \DB::raw('MONTH(time_in)'), '=', date("m") )
            ->where( \DB::raw('DAY(time_in)'), '=', date("d") )
            ->where( \DB::raw('YEAR(time_in)'), '=', date("Y") )
            ->get();

        $dt_yesterday = Carbon::yesterday(new \DateTimeZone('Asia/Manila'));
        $dt_today = Carbon::today(new \DateTimeZone('Asia/Manila'));
        $check_if_time_out_yesterday = DailyTimeRecord::where('employee_id','=',$id)
            ->where( \DB::raw('MONTH(time_in)'), '=', date("$dt_yesterday->month") )
            ->where( \DB::raw('DAY(time_in)'), '=', date("$dt_yesterday->day") )
            ->where( \DB::raw('YEAR(time_in)'), '=', date("$dt_yesterday->year") )
            ->whereNotNull('time_out')
            ->get();

        $check_if_present_yesterday = DailyTimeRecord::where('employee_id','=',$id)
            ->where( \DB::raw('MONTH(created_at)'), '=', date("$dt_yesterday->month") )
            ->where( \DB::raw('DAY(created_at)'), '=', date("$dt_yesterday->day") )
            ->where( \DB::raw('YEAR(created_at)'), '=', date("$dt_yesterday->year") )
            ->get();

        $check_if_time_in_and_out_today = DailyTimeRecord::where('employee_id','=',$id)
            ->where( \DB::raw('MONTH(time_in)'), '=', date("m") )
            ->where( \DB::raw('DAY(time_in)'), '=', date("d") )
            ->where( \DB::raw('YEAR(time_in)'), '=', date("Y") )
            ->whereNotNull('time_out')
            ->get();


        $details_array = array( 'employee_id' => $id, 
                                'date_now' => $date_now,
                        );
        // echo $check_if_time_in_and_out_today;
        $start_point = Carbon::create($dt_today->year, $dt_today->month, $dt_today->day, 0, 0, 0);
        $end_point = Carbon::create($dt_today->year, $dt_today->month, $dt_today->day, 3, 0, 0);
        // echo "<pre>";
        // var_dump($start_point);
        // var_dump($end_point);
        // echo $date_now->hour;
        // var_dump(Carbon::create($date_now->year, $date_now->month, $date_now->day, $date_now->hour, $date_now->minute, $date_now->second));

        // var_dump(Carbon::create($date_now->year, $date_now->month, $date_now->day, $date_now->hour, $date_now->minute, $date_now->second)->between($start_point, $end_point)); 
        if(sizeof($check_if_time_in_and_out_today) <= 0){
            if(sizeof($check_if_time_in_today) >= 1){
                $this->time_out($details_array,$dt_today->month,$dt_today->day,$dt_today->year);
            }
            else{
                if(sizeof($check_if_time_out_yesterday) >= 1){   
                    $this->time_in($details_array);
                }
                else{
                    if(sizeof($check_if_present_yesterday) >= 1){
                        //check if time between today is 12:00AM to 2:00 AM
                        if(Carbon::create($date_now->year, $date_now->month, $date_now->day, $date_now->hour, $date_now->minute, $date_now->second)->between($start_point, $end_point)){
                            $this->time_out($details_array,$dt_yesterday->month,$dt_yesterday->day,$dt_yesterday->year);
                        }
                        else{
                            $this->time_in($details_array);
                        }

                    }else{
                        $this->time_in($details_array);
                    }
                }
            }
        }else{
            echo "Already time-in and out today!";
        }

        // return Response::json(array('success'=> 'ok','data'=> $daily_time_records));
        // return response()->json($daily_time_records);
        // $daily_time_record = Employee::where('employee_no','=',"000000001")->pluck('id');
        // echo $daily_time_record;
    }

    public function time_in($details_array){
        // echo "TIME IN!!";

        DailyTimeRecord::create(array(
            'employee_id' => $details_array['employee_id'][0],
            'time_in' => $details_array['date_now']
        ));

    }

    public function time_out($details_array,$month,$day,$year){
        // echo "TIME OUT!!";
        // echo "<pre>";
        // var_dump($month);
        // var_dump($day);
        // var_dump($year);
        // var_dump($details_array);
        // var_dump($details_array['employee_id'][0]);
        $daily_time_record = DailyTimeRecord::where('employee_id','=',$details_array['employee_id'][0])
                            ->where( \DB::raw('MONTH(time_in)'), '=', date("$month") )
                            ->where( \DB::raw('DAY(time_in)'), '=', date("$day") )
                            ->where( \DB::raw('YEAR(time_in)'), '=', date("$year") )
                            ->update(['time_out' => $details_array['date_now']]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_no' => 'required|exists:employees,employee_no',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{
            

            //CHECK IF ALREADY TIMED-IN


            $date_now = Carbon::now(new \DateTimeZone('Asia/Manila'));

            $employee_no = request()->input('employee_no');
            $id = Employee::where('employee_no','=',$employee_no)->pluck('id');
             // echo date("Y/m/d H:i:s");
            $check_if_time_in_today = DailyTimeRecord::where('employee_id','=',$id)
                ->where( \DB::raw('MONTH(time_in)'), '=', date("m") )
                ->where( \DB::raw('DAY(time_in)'), '=', date("d") )
                ->where( \DB::raw('YEAR(time_in)'), '=', date("Y") )
                ->get();

            $dt_yesterday = Carbon::yesterday(new \DateTimeZone('Asia/Manila'));
            $dt_today = Carbon::today(new \DateTimeZone('Asia/Manila'));
            $check_if_time_out_yesterday = DailyTimeRecord::where('employee_id','=',$id)
                ->where( \DB::raw('MONTH(time_in)'), '=', date("$dt_yesterday->month") )
                ->where( \DB::raw('DAY(time_in)'), '=', date("$dt_yesterday->day") )
                ->where( \DB::raw('YEAR(time_in)'), '=', date("$dt_yesterday->year") )
                ->whereNotNull('time_out')
                ->get();

            $check_if_present_yesterday = DailyTimeRecord::where('employee_id','=',$id)
                ->where( \DB::raw('MONTH(created_at)'), '=', date("$dt_yesterday->month") )
                ->where( \DB::raw('DAY(created_at)'), '=', date("$dt_yesterday->day") )
                ->where( \DB::raw('YEAR(created_at)'), '=', date("$dt_yesterday->year") )
                ->get();

            $check_if_time_in_and_out_today = DailyTimeRecord::where('employee_id','=',$id)
                ->where( \DB::raw('MONTH(time_in)'), '=', date("m") )
                ->where( \DB::raw('DAY(time_in)'), '=', date("d") )
                ->where( \DB::raw('YEAR(time_in)'), '=', date("Y") )
                ->whereNotNull('time_out')
                ->get();



            $details_array = array( 'employee_id' => $id, 
                                    'date_now' => $date_now,
                            );
            // echo $check_if_time_in_and_out_today;
            $start_point = Carbon::create($dt_today->year, $dt_today->month, $dt_today->day, 0, 0, 0);
            $end_point = Carbon::create($dt_today->year, $dt_today->month, $dt_today->day, 3, 0, 0);
            // echo "<pre>";
            // var_dump($start_point);
            // var_dump($end_point);
            // echo $date_now->hour;
            // var_dump(Carbon::create($date_now->year, $date_now->month, $date_now->day, $date_now->hour, $date_now->minute, $date_now->second));

            // var_dump(Carbon::create($date_now->year, $date_now->month, $date_now->day, $date_now->hour, $date_now->minute, $date_now->second)->between($start_point, $end_point)); 
            if(sizeof($check_if_time_in_and_out_today) <= 0){
                if(sizeof($check_if_time_in_today) >= 1){
                    $this->time_out($details_array,$dt_today->month,$dt_today->day,$dt_today->year);
                }
                else{
                    if(sizeof($check_if_time_out_yesterday) >= 1){   
                        $this->time_in($details_array);
                    }
                    else{
                        if(sizeof($check_if_present_yesterday) >= 1){
                            //check if time between today is 12:00AM to 2:00 AM
                            if(Carbon::create($date_now->year, $date_now->month, $date_now->day, $date_now->hour, $date_now->minute, $date_now->second)->between($start_point, $end_point)){
                                $this->time_out($details_array,$dt_yesterday->month,$dt_yesterday->day,$dt_yesterday->year);

                            }
                            else{
                                $this->time_in($details_array);
                            }

                        }else{
                            $this->time_in($details_array);

                        }
                    }
                }
            }else{
                // echo "Already time-in and out today!";
                return response()->json(['errors' => array("employee_no"=>["You've already time-in and time-out today."]), 'status' => 400], 200);
                // return response()->json(['errors' => array("1"=>"You've already time-in and time-out today."), 'status' => 400], 200);
            }

            
            $user_record = DailyTimeRecord::where('daily_time_records.employee_id','=', $id)
                    ->leftJoin('employees', 'employees.id', '=', 'daily_time_records.employee_id')
                    ->select('*','daily_time_records.id','daily_time_records.deleted_at','daily_time_records.created_at','daily_time_records.updated_at')
                    ->orderBy('daily_time_records.updated_at','DESC')
                    ->first();
            

            return response()->json(array('success'=> true,'user_record'=>$user_record));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $validator = Validator::make($request->all(), [
            'employee_no' => 'exists:employees,employee_no',
            'time_in' => 'date(format)',
            'time_out' => 'required|date|after:time_in',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{
            $daily_time_record = DailyTimeRecord::find($id);
            // $daily_time_record->employee_id = request()->input('employee_no');
            // $daily_time_record->image = request()->input('image');
            $daily_time_record->save();

            // return Redirect::to('admin/users');
            return response()->json(array('success'=> true));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
