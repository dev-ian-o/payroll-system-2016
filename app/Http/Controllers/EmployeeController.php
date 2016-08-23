<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Employee;
use App\LeaveType;
use App\EmployeeLeaveCount;
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
        ->leftJoin('salaries', 'salaries.id', '=', 'employees.salary_id')
        ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
        ->get();

        // $employees = Employee::where('employees.deleted_at', '=', NULL)
        // ->join(\DB::raw('(SELECT * FROM salaries) salaries') , function($join){
        //     $join->on('salaries.employee_id', '=', 'employees.id');
        //         // ->orderBy('created_at', 'desc');
        //         // ->first();
        // })
        // $employees = Employee::where('employees.deleted_at', '=', NULL)
        // ->leftJoin('salaries' , function($join){
        //     $join->on('salaries.employee_id', '=', 'employees.id')
        //         ->where('salaries.deleted_at', '=', NULL);
        //         // ->orderBy('created_at', 'desc');
        //         // ->first();
        // })
        // ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
        // ->get();


 // ->join(DB::raw('(SELECT user_id, COUNT(user_id) TotalCatch, DATEDIFF(NOW(), MIN(created_at)) Days, COUNT(user_id)/DATEDIFF(NOW(), MIN(created_at)) CatchesPerDay FROM `catch-text` GROUP BY user_id) TotalCatches'), function($join)
 //        {
 //            $join->on('users.id', '=', 'TotalCatches.user_id');
 //        })
            return response()->json(array('success'=> true, 'data' => $employees));
        // dd(response()->json($employees));
        // dd($employees);
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
            'basic_pay' => 'required|min:1|numeric',
            'sss_contribution' => 'required|min:1|numeric',
            'pagibig_contribution' => 'required|min:1|numeric',
            'philhealth_contribution' => 'required|min:1|numeric',
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
                'middlename' => request()->input('middlename'),
                'lastname' => request()->input('lastname'),
                'birthdate' => request()->input('birthdate'),
                'address' => request()->input('address'),
                'city' => request()->input('city'),
                'province' => request()->input('province'),
                'zip_code' => request()->input('zip_code'),
                'civil_status_code_id' => request()->input('civil_status_code_id'),
                'salary_id' => $salary_id,
            ))->id;

            foreach (LeaveType::where('deleted_at',null)->get() as $key => $value){
                EmployeeLeaveCount::create(array(
                    'employee_id' => $employee_id,
                    'leave_type_id' => $value->id,
                    'total_leave_count' => $value->default_no_per_employee,
                    'actual_leave_count' => $value->default_no_per_employee,
                ));

            }


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
    public function edit($id,Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'username' => "required|unique:users,username,$id|max:255|min:5",
        //     'email' => "required|unique:users,email,$id|email",
        //     'password' => 'required|min:5|confirmed',
        //     'user_group_id' => 'required|exists:user_groups,id'
        // ]);

        $validator = Validator::make($request->all(), [
            'employee_no' => "required|unique:employees,employee_no,$id|max:255|min:1",
            'firstname' => 'required|min:1',
            'lastname' => 'required|min:1',
            'middlename' => 'min:1',
            'birthdate' => 'required|date',
            'address' => 'required|min:1',
            'city' => 'required|min:1',
            'province' => 'required|min:1',
            'zip_code' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{
            $employee = Employee::find($id);
            $employee->employee_no = request()->input('employee_no');
            $employee->firstname = request()->input('firstname');
            $employee->middlename = request()->input('middlename');
            $employee->lastname = request()->input('lastname');
            $employee->birthdate = request()->input('birthdate');
            $employee->address = request()->input('address');
            $employee->city = request()->input('city');
            $employee->province = request()->input('province');
            $employee->zip_code = request()->input('zip_code');
            $employee->salary_id = request()->input('salary_id');
            // $employee->image = request()->input('image');
            $employee->save();

            // return Redirect::to('admin/users');
            return response()->json(array('success'=> true));
        }
        // return response()->json(array('success'=> true));
        
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
        $user = Employee::find($id);
        $user->deleted_at = date('Y-m-d h:m:s');
        $user->save();

        // return Redirect::to('admin/users');
        return response()->json(array('success'=> true));

    }
}
