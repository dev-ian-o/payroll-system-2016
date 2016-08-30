<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use App\OvertimeRecord;
use Carbon\Carbon;

class OvertimeRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'date_from' => 'required|date',
        //     'date_to' => 'required|date',
        //     'employee_id' => 'required|exists:employees,id'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        // }else{

        //     OvertimeRecord::create(array(
        //         'employee_id' => request()->input('employee_id'),
        //         'date_from' => request()->input('date_from'),
        //         'date_to' => request()->input('date_to'),
        //     ));
        //     return response()->json(array('success'=> true));

        // }
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
            'employee_id' => 'required|exists:employees,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{
            $date_from = Carbon::createFromFormat('Y-m-d h:i A', request()->input('date_from').' '.request()->input('time_from') )->format('Y-m-d H:i:s');
            $date_to = Carbon::createFromFormat('Y-m-d h:i A', request()->input('date_to').' '.request()->input('time_to') )->format('Y-m-d H:i:s');

            OvertimeRecord::create(array(
                'employee_id' => request()->input('employee_id'),
                'date_from' => $date_from,
                'date_to' =>   $date_to,
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
