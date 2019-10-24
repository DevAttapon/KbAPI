<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PayModel;
use App\CourseModel;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewCourse = CourseModel::all();
        return response()->json([
            "message" => "success",
            "data" => $NewCourse
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
        if($request->file('course_pic')!=''){
            $pic=Storage::putFile('', $request->file('course_pic'));
        }
        
        CourseModel::create([
            'course_name' => $request->course_name,
            'course_price' => $request->course_price,
            'course_price_pro' => $request->course_price_pro,
            'course_detail' => $request->course_detail,
            'course_pic' => $pic,
            'username' => $request->username,
            'category_id' => $request->category_id
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
        $NewCourse = CourseModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $NewCourse
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
        $NewCourse = CourseModel::find($id);
        if($request->course_name!=''){
            $NewCourse->course_name = $request->course_name;
        }
        if($request->course_price!=''){
            $NewCourse->course_price = $request->course_price;
        }
        if($request->course_price_pro!=''){
            $NewCourse->course_price_pro = $request->course_price_pro;
        }
        if($request->course_detail!=''){
            $NewCourse->course_detail = $request->course_detail;
        }
        if($request->file('course_pic')!=''){
            $pic=Storage::putFile('', $request->file('course_pic'));
        }else{
            $pic=$NewCourse->course_pic;
        }
        $NewCourse->course_pic = $pic;
        if($request->username!=''){
            $NewCourse->username =  $request->username;
        }
        if($request->category_id!=''){
            $NewCourse->category_id = $request->category_id;
        }
       
        $NewCourse->save();
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
        $NewCourse = CourseModel::find($id);
        if($NewCourse->course_pic!=''){
            Storage::delete($NewCourse->course_pic);
        }
        $NewCourse->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    }


    public function courseByCategory($id){
        $query = DB::table('course')
                ->where('category_id', '=',$id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);
            
    }
}
