<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewVideo = VideoModel::all();
        return response()->json([
            "message" => "success",
            "data" => $NewVideo
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
        if($request->file('video_link')!=''){
            $video=Storage::putFile('', $request->file('video_link'));
            $type=$request->file('video_link')->getMimeType();
        }
        VideoModel::create([
            'video_link' => $video,
            'video_type' => $type,
            'video_detail' => $request->video_detail,
            'video_status' => $request->video_status,
            'username' => $request->username,
            'course_id' => $request->course_id,
            'lesson_id' => $request->lesson_id
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
        $NewVideo = VideoModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $NewVideo
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
        $NewCourseVideo = VideoModel::find($id);
        if($request->file('video_link')!=''){
            $video=Storage::putFile('', $request->file('video_link'));
            $type=$request->file('video_link')->getMimeType();
        }else{
            $video=$NewCourseVideo->video_link;
            $type=$NewCourseVideo->video_type;
        }
        $NewCourseVideo->video_link = $video;
        $NewCourseVideo->video_type = $type;

        if($request->video_detail!=''){
            $NewCourseVideo->video_detail = $request->video_detail;
        }
        if($request->video_status!=''){
            $NewCourseVideo->video_status =  $request->video_status;
        }
        if($request->username!=''){
            $NewCourseVideo->username = $request->username;
        }
        if($request->course_id!=''){
            $NewCourseVideo->course_id = $request->course_id;
        }
        if($request->lesson_id!=''){
            $NewCourseVideo->lesson_id = $request->lesson_id;
        }

        $NewCourseVideo->save();

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
        $NewCourseVideo = VideoModel::find($id);
        if($NewCourseVideo->video_link!=''){
            Storage::delete($NewCourseVideo->video_link);
        }
        $NewCourseVideo->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    }
}
