<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Holiday;
use App\HolidayType;

use Validator;

class HolidayController extends Controller
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
            'holiday' => 'required|min:1',
            'date' => 'required|date',
            'holiday_type_id' => 'required|min:1',
        ]);


        // $messages = [
        //     'required'    => 'The :attribute is required.',
        //     'min' => 'The :attribute must be :min characters.',
        //     'in'      => 'The :attribute must be one of the following types: :values',
        // ];


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

            Holiday::create(array(
                'holiday' => request()->input('holiday'),
                'date' => request()->input('date'),
                'holiday_type_id'    => request()->input('holiday_type_id'),
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
    public function edit($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'holiday' => 'required|min:1',
            'date' => 'required|date',
            'holiday_type_id' => 'required|min:1',
        ]);


        // $messages = [
        //     'required'    => 'The :attribute is required.',
        //     'min' => 'The :attribute must be :min characters.',
        //     'in'      => 'The :attribute must be one of the following types: :values',
        // ];


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 200);
        }else{

            
            $holiday = Holiday::find($id);
            $holiday->holiday = request()->input('holiday');
            $holiday->date = request()->input('date');
            $holiday->holiday_type_id = request()->input('holiday_type_id');
            $holiday->save();

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
        $user = Holiday::find($id);
        $user->deleted_at = date('Y-m-d h:m:s');
        $user->save();

        // return Redirect::to('admin/users');
        return response()->json(array('success'=> true));
    }
}
