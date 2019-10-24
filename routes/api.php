<?php


Route::get('/',function(){
        return "Api home...";
});

Route::group([
    'middleware' => 'api',
], function ($router) {

    Route::post('login', 'UserController@authenticate');
    Route::post('signup','UserController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');


    Route::apiResource('category','CategoryController');
    Route::apiResource('course','CourseController');
    Route::apiResource('video','VideoController');
    Route::apiResource('pay','PayController');
    Route::apiResource('privilege','PrivilegeController');
    Route::apiResource('lesson','LessonController');
    Route::apiResource('bank','BankController');
    Route::apiResource('manageUser','ManageUserController');
    Route::apiResource('address','AddressController');
    Route::get('courseByCategory/{id}', 'SelectDataController@courseByCategory');
    Route::get('courseByUsername/{id}', 'SelectDataController@courseByUsername');
    Route::get('lessonByCourse/{id}', 'SelectDataController@lessonByCourse');
    Route::get('lessonByUsername/{id}', 'SelectDataController@lessonByUsername');
    Route::get('payByCourse/{id}', 'SelectDataController@payByCourse');
    Route::get('payByUsername/{id}', 'SelectDataController@payByUsername');
    Route::get('privilegeByCourse/{id}', 'SelectDataController@privilegeByCourse');
    Route::get('privilegeByUsername/{id}', 'SelectDataController@privilegeByUsername');
    Route::get('videoByCourse/{id}', 'SelectDataController@videoByCourse');
    Route::get('videoByUsername/{id}', 'SelectDataController@videoByUsername');
    Route::get('videoByLesson/{id}', 'SelectDataController@videoByLesson');
    Route::get('courseByName/{id}', 'SelectDataController@courseByName');
    Route::post('payStatus', 'PayController@payStatus');
    Route::get('getBearer/{id}', 'SelectDataController@getBearer');
    Route::get('addressByUsername/{id}', 'SelectDataController@addressByUsername');
    Route::get('fullCourse/{id}', 'SelectDataController@fullCourse');
    Route::get('courseByCategory/{id}','CourseController@courseByCategory');
    Route::get('getImage/{id}', 'SelectDataController@getImage');
});
/// Route pass middleware JWT Authen
Route::group(['middleware' => ['jwt.verify','cors']], function() {
    Route::get('getBearer/{id}', 'SelectDataController@getBearer');
   
});