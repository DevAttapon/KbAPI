<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddressModel;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Address = AddressModel::all();
        return response()->json([
            "message" => "success",
            "data" => $Address
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
       
        AddressModel::create([
            'address' => $request->address,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'zipcode' => $request->zipcode,
            'tel' => $request->tel,
            'username' => $request->username
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
        $Address = AddressModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $Address
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
        $Address = AddressModel::find($id);
        if($request->address!=''){
            $Address->address = $request->address;
        }
        if($request->subdistrict!=''){
            $Address->subdistrict = $request->subdistrict;
        }
        if($request->district!=''){
            $Address->district = $request->district;
        }
        if($request->province!=''){
            $Address->province = $request->province;
        }
        if($request->zipcode!=''){
            $Address->zipcode = $request->zipcode;
        }
        if($request->tel!=''){
            $Address->tel = $request->tel;
        }
        if($request->username!=''){
            $Address->username = $request->username;
        }
        $Address->save();

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
        $Address = AddressModel::find($id);
        $Address->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    }

}
