<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Employee;
use App\Salary;

use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('employees.deleted_at', '=', NULL)
        ->leftJoin('salaries', 'salaries.id', '=', 'employees.id')
        ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
        ->get();
        // return Response::json(array('success'=> 'ok','data'=> $employees));
        return response()->json($employees);
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
        // $validator = Validator::make($request->all(), [
        //     'employee_no' => 'required|unique:users,username|max:255|min:5',
        //     'email' => 'required|unique:users,email|email',
        //     'password' => 'required|min:5|confirmed',
        //     'user_group_id' => 'required|exists:user_groups,id'
        // ]);
        $validator = Validator::make($request->all(), [
            'employee_no' => 'required|unique:employees,employee_no|max:255|min:1',
            'firstname' => 'required|min:1',
            'lastname' => 'required|min:1',
            'middlename' => 'min:1',
            'birthdate' => 'required|date',
            'address' => 'required|min:1',
            'city' => 'required|min:1',
            'province' => 'required|min:1',
            'zip_code' => 'required|min:1',
            'civil_status_code_id' => 'required|exists:civil_status_codes,id',
        ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        // }else{

        //     User::create(array(
        //         'username' => request()->input('username'),
        //         'password' => bcrypt(request()->input('password')),
        //         'email'    => request()->input('email'),
        //         'user_group_id' => request()->input('user_group_id')
        //     ));
        //     return response()->json(array('success'=> true));

        // }
        // $salary_id ="1";
        // $employee_id = "00000004";

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

            $salary_id = Salary::create(array( 
                'basic_pay' => request()->input('basic_pay'), 
                'sss_contribution' => request()->input('sss_contribution'), 
                'pagibig_contribution' => request()->input('pagibig_contribution'), 
                'philhealth_contribution' => request()->input('philhealth_contribution') 
            ))->id;

            $employee_id = Employee::create(array(
                'employee_no' => request()->input('employee_no'),
                'firstname' => request()->input('firstname'),
                'lastname' => request()->input('lastname'),
                'birthdate' => request()->input('birthdate'),
                'address' => request()->input('address'),
                'city' => request()->input('city'),
                'province' => request()->input('province'),
                'zip_code' => request()->input('zip_code'),
                'civil_status_code_id' => request()->input('civil_status_code_id'),
                'salary_id' => $salary_id,
            ))->id;

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
