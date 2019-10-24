<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewBank = BankModel::all();
        return response()->json([
            "message" => "success",
            "data" => $NewBank
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
        if($request->file('bank_pic')!=''){
            $pic=Storage::putFile('', $request->file('bank_pic'));
        }
        BankModel::create([
            'bank_name' => $request->bank_name,
            'bank_owner_name' => $request->bank_owner_name,
            'bank_no' => $request->bank_no,
            'bank_pic' => $pic,
            'username' => $request->username
        ]);
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
        $NewBank = BankModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $NewPay
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
        $NewBank = BankModel::find($id);
        if($request->file('bank_pic')!=''){
            $pic=Storage::putFile('', $request->file('bank_pic'));
        }else{
            $pic = $NewBank->bank_pic;
        }
        $NewBank->bank_pic = $pic;
        $NewBank->bank_name = $request->bank_name;
        $NewBank->bank_owner_name = $request->bank_owner_name;
        $NewBank->bank_no = $request->bank_no;
        $NewBank->username = $request->username;
        $NewBank->save();

        return response()->json([
            'message' => 'Update success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $NewPay = BankModel::find($id);
        if($NewPay->bank_pic!=''){
            Storage::delete($NewPay->bank_pic);
        }
        $NewPay->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
