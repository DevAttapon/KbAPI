<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivilegeModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewPrivilege = PrivilegeModel::all();
        return response()->json([
            "message" => "success",
             "data" => $NewPrivilege
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PrivilegeModel::create([
            'username' => $request->username,
            'course_id' => $request->course_id,
            'p_datetime_start' => $request->p_datetime_start,
            'p_datetime_end' => $request->p_datetime_end,
            'p_status' => $request->p_status
        ]);
        return response()->json([
            'message' => 'Insert success'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $NewPrivilege = PrivilegeModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $NewPrivilege
        ],200);
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
        $NewPrivilege = PrivilegeModel::find($id);
        if($request->username!=''){
            $NewPrivilege->username = $request->username;
        }
        if($request->course_id!=''){
            $NewPrivilege->course_id = $request->course_id;
        }
        if($request->p_datetime_start!=''){
            $NewPrivilege->p_datetime_start = $request->p_datetime_start;
        }
        if($request->p_datetime_end!=''){
            $NewPrivilege->p_datetime_end = $request->p_datetime_end;
        }
        if($request->p_status!=''){
            $NewPrivilege->p_status = $request->p_status;
        }

        $NewPrivilege->save();

        return response()->json([
            'message' => 'Update success'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $NewPrivilege = PrivilegeModel::find($id);
        $NewPrivilege->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    }
}
