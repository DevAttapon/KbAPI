<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LessonModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class LessonController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $NewLesson = LessonModel::all();
        return response()->json([
            "message" => "success",
            "data" => $NewLesson
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
        LessonModel::create([
            'lesson_name' => $request->lesson_name,
            'lesson_detail' => $request->lesson_detail,
            'username' => $request->username,
            'course_id' => $request->course_id
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
        $NewLesson = LessonModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $NewLesson
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
        $NewPay = LessonModel::find($id);
        if($request->lesson_name!=''){
            $NewPay->lesson_name = $request->lesson_name;
        }
        if($request->lesson_detail!=''){
            $NewPay->lesson_detail = $request->lesson_detail;
        }
        if($request->username!=''){
            $NewPay->username = $request->username;
        }
        if($request->course_id!=''){
            $NewPay->course_id = $request->course_id;
        }
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
        $NewLesson = LessonModel::find($id);
        $NewLesson->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    }
}
