<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('storage/{id}', function(){
    return "storage";
});
// Route::group(['middleware' => ['jwt.verify','cors']], function() {
//     Route::get('storage/{id}', 'SelectDataController@getBearer');
   
// });