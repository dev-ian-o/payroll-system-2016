<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Validator;

class UserController extends Controller
{
    public function index()
	{
		$users = User::where('users.deleted_at', '=', NULL)
        ->leftJoin('user_groups', 'users.user_group_id', '=', 'user_groups.id')
        ->select('*','users.id','users.deleted_at','users.created_at','users.updated_at')
        ->get();
		// return Response::json(array('success'=> 'ok','data'=> $users));
		return response()->json($users);
	}


	public function store(Request $request)
	{

		$validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|max:255|min:5',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|confirmed',
            'user_group_id' => 'required|exists:user_groups,id'
        ]);


		// $messages = [
		//     'required'    => 'The :attribute is required.',
		//     'min' => 'The :attribute must be :min characters.',
		//     'in'      => 'The :attribute must be one of the following types: :values',
		// ];


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

        	User::create(array(
	            'username' => request()->input('username'),
	            'password' => bcrypt(request()->input('password')),
	            'email'    => request()->input('email'),
	            'user_group_id' => request()->input('user_group_id')
	        ));
			return response()->json(array('success'=> true));

        }

		
		// User::create(array(
  //           'username' => "assa",
  //           'password' => Hash::make(request()->input('password')),
  //           'email'    => "sadasda",
  //           'user_group_id' => "request()->input('user_group_id')"
  //       ));


		// dd(request()->all());
		
		// return response()->json(array('success'=> true));
		// return response()->json(array('success'=> true));

		// return Redirect::to('admin/users');
	}

	public function show($id)
	{
		$data = User::where('id','=', $id)->get();
		return response()->json($data);
	}


	public function edit($id,Request $request)
	{

		$validator = Validator::make($request->all(), [
            'username' => "required|unique:users,username,$id|max:255|min:5",
            'email' => "required|unique:users,email,$id|email",
            'password' => 'required|min:5|confirmed',
            'user_group_id' => 'required|exists:user_groups,id'
        ]);
		if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{
			$user = User::find($id);
			$user->user_group_id = request()->input('user_group_id');
			$user->username = request()->input('username');
			$user->email = request()->input('email');
			$user->password = bcrypt(request()->input('password'));
			$user->save();

			// return Redirect::to('admin/users');
			return response()->json(array('success'=> true));
		}
	}


	public function destroy($id)
	{
		//
		// dd(request()->all());
		
		$user = User::find($id);
		$user->deleted_at = date('Y-m-d h:m:s');
		$user->save();

		// return Redirect::to('admin/users');
		return response()->json(array('success'=> true));

	}

}
