<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Employee;
use App\Salary;
use Validator;

class SalaryController extends Controller
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
            'basic_pay' => 'required|min:1|numeric',
            'sss_contribution' => 'required|min:1|numeric',
            'pagibig_contribution' => 'required|min:1|numeric',
            'philhealth_contribution' => 'required|min:1|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

            $salary_id = Salary::create(array( 
                'employee_id' => request()->input('id'),
                'basic_pay' => request()->input('basic_pay'), 
                'sss_contribution' => request()->input('sss_contribution'), 
                'pagibig_contribution' => request()->input('pagibig_contribution'), 
                'philhealth_contribution' => request()->input('philhealth_contribution') 
            ))->id;

            $employee = Employee::find(request()->input('id'));
            $employee->salary_id = $salary_id;
            $employee->civil_status_code_id = request()->input('civil_status_code_id');
            $employee_id = $employee->save();


            \DB::table('salaries')
                ->where('id', $salary_id)
                ->update(['employee_id' => $employee_id]);
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
