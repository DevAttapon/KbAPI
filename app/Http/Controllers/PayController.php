<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewPay = PayModel::all();
        return response()->json([
            "message" => "success",
            "data" => $NewPay
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
        if($request->file('pay_pic')!=''){
            $pic=Storage::putFile('', $request->file('pay_pic'));
        }
        PayModel::create([
            'pay_price' => $request->pay_price,
            'pay_pic' => $pic,
            'pay_datetime' => $request->pay_datetime,
            'pay_bank' => $request->pay_bank,
            'course_id' => $request->course_id,
            'username' => $request->username,
            'pay_status' => $request->pay_status
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
        $NewPay = PayModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $NewPay
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
        $NewPay = PayModel::find($id);
        if($request->pay_price!=''){
            $NewPay->pay_price = $request->pay_price;
        }
        
        if($request->file('pay_pic')!=''){
            $pic=Storage::putFile('', $request->file('pay_pic'));
        }else{
            $pic=$NewPay->pay_pic;
        }

        $NewPay->pay_pic = $pic;
        if($request->pay_datetime!=''){
            $NewPay->pay_datetime = $request->pay_datetime;
        }
        if($request->pay_bank!=''){
            $NewPay->pay_bank = $request->pay_bank;
        }
        if($request->course_id!=''){
            $NewPay->course_id = $request->course_id;
        }
        if($request->username!=''){
            $NewPay->username = $request->username;
        }
        //$NewPay->pay_status = $request->pay_status;
        $NewPay->save();

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
        $NewPay = PayModel::find($id);
        if($NewPay->pay_pic!=''){
            Storage::delete($NewPay->pay_pic);
        }
        $NewPay->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    }

    public function payStatus(Request $request)
    {
        $NewPay = PayModel::find($request->id);
        $NewPay->pay_status = $request->pay_status;
        $NewPay->save();

        return response()->json([
            'message' => 'Update Pay Status Success'
        ],200);
    }

}
