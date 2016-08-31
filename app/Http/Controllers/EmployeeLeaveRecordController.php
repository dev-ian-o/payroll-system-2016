<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\EmployeeLeaveRecord;
use App\EmployeeLeaveCount;
use Validator;
use Carbon\Carbon;

class EmployeeLeaveRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'employee_id' => 'required',
            'leave_type_id' => 'required'
        ]);


        // $messages = [
        //     'required'    => 'The :attribute is required.',
        //     'min' => 'The :attribute must be :min characters.',
        //     'in'      => 'The :attribute must be one of the following types: :values',
        // ];


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

            $date_from = Carbon::createFromFormat('Y-m-d', request()->input('date_from') );
            $date_to = Carbon::createFromFormat('Y-m-d', request()->input('date_to') )->addDay();
            // $dt = Carbon::create(2014, 1, 1);
            // $dt2 = Carbon::create(2014, 12, 31);
            $total_weekdays_leave = $date_from->diffInDaysFiltered(function(Carbon $date) {
               return $date->isWeekday();
            }, $date_to);

            $actual_leave_count = EmployeeLeaveCount::where('employee_id','=',request()->input('employee_id'))
                ->where('leave_type_id','=',request()->input('leave_type_id'))->pluck('actual_leave_count')[0];

            $actual_leave_count = $actual_leave_count - $total_weekdays_leave;
                   
            EmployeeLeaveCount::where('employee_id','=',request()->input('employee_id'))
                ->where('leave_type_id','=',request()->input('leave_type_id'))
                ->where('total_leave_count','<>','0')
                ->decrement('actual_leave_count', $total_weekdays_leave);



            EmployeeLeaveRecord::create(array(
                'date_from' => request()->input('date_from'),
                'date_to' => request()->input('date_to'),
                'employee_id' => request()->input('employee_id'),
                'leave_type_id' => request()->input('leave_type_id'),
            ));


            return response()->json(array('success'=> true));

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
        //
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
