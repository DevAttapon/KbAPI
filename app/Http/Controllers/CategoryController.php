<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = CategoryModel::all();
        return response()->json([
            "message" => "success",
            "data" => $cate
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
        CategoryModel::create([
            'category_name' => $request->category_name,
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
        $newCate = CategoryModel::find($id);
        return response()->json([
            "message" => "success",
            "data" => $newCate
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
        $newCate = CategoryModel::find($id);
        if($request->category_name!=''){
            $newCate->category_name = $request->category_name;
        }
        if($request->username!=''){
            $newCate->username = $request->username;
        }
       
        $newCate->save();

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
        $delCate = CategoryModel::find($id);
        $delCate->delete(); 
       
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
