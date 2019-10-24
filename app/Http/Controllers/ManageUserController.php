<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::all();
        return response()->json([
            "message" => "success",
            "data" => $User
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all());
        return response()->json([
            'message' => 'Insert success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User = User::find($id);
        return response()->json([
            "message" => "success",
            "data" => $User
        ]);
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
        $User = User::find($id);
        if($request->name!=''){
            $User->name = $request->name;
        }
        if($request->password!=''){
            $User->password = $request->password;
        }
        if($request->user_status!=''){
            $User->user_status = $request->user_status;
        }
        if($request->user_type!=''){
            $User->user_type = $request->user_type;
        }
        $User->save();
        return response()->json(['message' => 'Update Profile Success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::find($id);
        $User->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ]);
    }

}
