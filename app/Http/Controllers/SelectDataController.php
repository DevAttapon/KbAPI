<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PayModel;
use App\HomeImageModel;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use File;
class SelectDataController extends Controller
{
    public function courseByCategory($id){
        $query = DB::table('course')
                ->where('category_id', '=',$id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);
            
    }

    public function courseByUsername($id){
        $query = DB::table('pay')
        ->where('username', $id)
        ->where('pay_status', 1) 
        ->get()->toArray();
      
        foreach($query as $l){
            $data2 = DB::table('course')
            ->where('id', $l->course_id)                          
            ->get()->toArray();
           }
           return response()->json(["data" => $data2],200);   
            
    }

    public function lessonByCourse($id){
        $query = DB::table('lesson')
                ->where('course_id', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);
            
    }

    public function lessonByUsername($id){
        $query = DB::table('lesson')
                ->where('username', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);
            
    }

    public function payByCourse($id){
        $query = DB::table('pay')
                ->where('course_id', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);
            
    }

    public function payByUsername($id){
        $query = DB::table('pay')
                ->where('username', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);
            
    }

    public function privilegeByCourse($id){
        $query = DB::table('privilege')
                ->where('course_id', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function privilegeByUsername($id){
        $query = DB::table('privilege')
                ->where('username', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function videoByCourse($id){
        $query = DB::table('video')
                ->where('course_id', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function videoByUsername($id){
        $query = DB::table('video')
                ->where('username', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function videoByLesson($id){
        $query = DB::table('video')
                ->where('lesson_id', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function courseByName($id){
        $query = DB::table('course')
                ->where('course_name', 'like', '%'.$id.'%')
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function getImage($id){       
      $path = Storage::url($id);      
     
      return response()->json(['path' => $path],200);        
    }
    public function getBearer($id){       
     // $s_path = Storage::url($id);  
      $s_path = storage_path() . '/app/public/' . $id ;

      $file = File::get($s_path);
      if(!File::exists($s_path)) abort(404);
      
              $type = File::mimeType($s_path);
              $headers = [ 'Content-Type' => 'video/mp4', ];
           return Response::download($s_path,'test.mp4',$headers); 
    }

    private function bearerToken()
    {
        $header = $this->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
                    return Str::substr($header, 7);
        }
    }

    public function addressByUsername($id){
        $query = DB::table('address')
                ->where('username', '=', $id)
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function fullCourse($id){
     
        $query = DB::table('course')
                ->where('course.id', '=', $id)
                ->get()->toArray();
               
       foreach($query as $l){
        $data2 = $l->lesson = DB::table('lesson')
        ->where('course_id', '=', $l->id)
        ->get()->toArray();

       }
       foreach($data2 as $v){
        $v->video = DB::table('video')
        ->where('lesson_id', '=', $v->id)
        ->get()->toArray();
       }

        return response()->json([
            "course" => $query
        ],200);   
    }
    public function orderHistory($id){
        $query = DB::table('pay')
        ->where('username', $id)
        ->get()->toArray();
      
        foreach($query as $l){
            $data2 = $l->course = DB::table('course')
            ->where('id', $l->course_id)
            ->select('id','course_name')
            ->get()->toArray();
           }
           return response()->json(["pay" => $query],200);   
    }

    public function getEmail(Request $request){
        $query = DB::table('users')
                ->where('email', '=', $request->email)
                ->select('email')
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }
    public function getEmailWithRefrashToken($token){
        $query = DB::table('password_resets')
                ->where('token', '=', $token)
                ->select('email')
                ->get();
        return response()->json([
            "data" => $query
        ],200);   
    }

    public function newTitleImage(Request $request)
    {
        if($request->file('image')!=''){
            $pic=Storage::putFile('/public', $request->file('image'));
        }
        HomeImageModel::create([
            'title_image' => $pic       
        ]);
        return response()->json([
            'message' => 'Insert success'
        ]);
    }
    public function TitleImage()
    {
        $NewPay = HomeImageModel::all();
        return response()->json([
            "message" => "success",
            "data" => $NewPay
        ],200);
    }
    public function TitleImageDel($id)
    {
        $NewPay = HomeImageModel::find($id);
        if($NewPay->title_image!=''){
            Storage::delete($NewPay->title_image);
        }
        $NewPay->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ],200);
    } 
    public function getTitleImage()
    {
        $someUsers = HomeImageModel::orderBy('created_at', 'desc')->paginate(1);
        return response()->json([
            "data" => $someUsers
        ],200);   
    }
}
