<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\LeaveType;

use App\EmployeeLeaveCount;

use App\Employee;


use Validator;


class LeaveTypeController extends Controller
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
            'leave_type' => 'required|unique:leave_types|min:1',
            'default_no_per_employee' => 'required|min:0|numeric',
        ]);




        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);

        }else{

            $leave_type_id = LeaveType::create(array(
                'leave_type' => request()->input('leave_type'),
                'default_no_per_employee' => request()->input('default_no_per_employee'),
            ))->id;

            foreach (Employee::where('deleted_at',null)->get() as $key => $value){
                EmployeeLeaveCount::create(array(
                    'employee_id' => $value->id,
                    'leave_type_id' => $leave_type_id,
                    'total_leave_count' => request()->input('default_no_per_employee'),
                    'actual_leave_count' => request()->input('default_no_per_employee'),
                ));

            }
            

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
    public function edit($id,Request $request)
    {
         $validator = Validator::make($request->all(), [
            'leave_type' => "required|unique:leave_types,leave_type,$id|min:1",
            'default_no_per_employee' => 'required|min:0|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{
            $user = LeaveType::find($id);
            $user->leave_type = request()->input('leave_type');
            $user->default_no_per_employee = request()->input('default_no_per_employee');
            $user->save();

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
        $user = LeaveType::find($id);
        $user->deleted_at = date('Y-m-d h:m:s');
        $user->save();

        // return Redirect::to('admin/users');
        return response()->json(array('success'=> true));

    }
}
