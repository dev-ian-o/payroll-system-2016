<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\PaySetting;

use Validator;

class PaySettingController extends Controller
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
                'first_nine_hrs_pay' => 'required|numeric|min:1',
                'excess_of_nine_hrs_pay' => 'required|numeric|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
            }else{
                $user = PaySetting::find($id);
                $user->first_nine_hrs_pay = request()->input('first_nine_hrs_pay');
                $user->excess_of_nine_hrs_pay = request()->input('excess_of_nine_hrs_pay');
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
    public function update($id,Request $request)
    {
      
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
