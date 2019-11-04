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
    Route::get('courseRecommend', 'CourseController@courseRecommend'); //คอร์สเรียนแนะนำ
    Route::get('coursePopular', 'CourseController@coursePopular'); //คอร์สเรียนยอดนิยม
    

    Route::apiResource('category','CategoryController');
    Route::apiResource('course','CourseController');
    Route::apiResource('video','VideoController');
    Route::apiResource('pay','PayController');
    Route::apiResource('privilege','PrivilegeController');
    Route::apiResource('lesson','LessonController');
    Route::apiResource('bank','BankController');
    Route::apiResource('manageUser','ManageUserController');
  
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
    Route::get('fullCourse/{id}', 'SelectDataController@fullCourse');//รายละเอียด Course , Lesson , Video ที่ Join ผ่าน course_id
    Route::post('getEmail','SelectDataController@getEmail');
    Route::get('getEmailWithRefrashToken/{token}','SelectDataController@getEmailWithRefrashToken');
    Route::get('PayList','PayController@PayList');
    Route::get('PayListConfirm','PayController@PayListConfirm');
    Route::post('newTitleImage','SelectDataController@newTitleImage');
    Route::get('TitleImage','SelectDataController@TitleImage');
    Route::get('TitleImageDel/{id}','SelectDataController@TitleImageDel');
    Route::get('getTitleImage','SelectDataController@getTitleImage');
});
/// Route pass middleware JWT Authen
Route::group(['middleware' => ['jwt.verify','cors']], function() {
    Route::get('getBearer/{id}', 'SelectDataController@getBearer');
    Route::get('orderHistory/{id}', 'SelectDataController@orderHistory');//ประวัติการสั่งซื้อของคุณ
    Route::post('changePassword', 'ManageUserController@changePassword');//เปลี่ยน password
    Route::apiResource('address','AddressController');
   
});