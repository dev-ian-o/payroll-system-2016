<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\NightDiffSetting;
use Validator;
use Carbon\Carbon;

class NightDiffSettingController extends Controller
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
            'nd_shift_time_start' => 'required',
            'nd_shift_time_end' => 'required',
            'nd_pay' => 'required|numeric|min:1',
        ]);


        // $messages = [
        //     'required'    => 'The :attribute is required.',
        //     'min' => 'The :attribute must be :min characters.',
        //     'in'      => 'The :attribute must be one of the following types: :values',
        // ];


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

            $daily_start_shift = Carbon::createFromFormat('h:i A', request()->input('nd_shift_time_start') )->format('H:i:s');
            $daily_end_shift = Carbon::createFromFormat('h:i A', request()->input('nd_shift_time_end') )->format('H:i:s');

            NightDiffSetting::create(array(
                'nd_shift_time_start' => $daily_start_shift,
                'nd_shift_time_end' => $daily_end_shift,
                'nd_pay'    => request()->input('nd_pay')
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
