<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//user routes
Route::group(['prefix' => 'user'], function (){
    Route::get('/{user_id}','api\AuthController@getProfile');
    //auth routes
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'api\AuthController@login');
        Route::post('activate', 'api\AuthController@activateAccount');
        Route::post('signup', 'api\AuthController@signup')->middleware('unwrapFromJson');
        Route::post('update_password', 'api\AuthController@changePassword');
    });
});

//category routes
Route::group(['prefix' => 'category'], function () {
    Route::get('list', 'api\CategoryController@index');
    Route::get('subcategory/{category_id}', 'api\CategoryController@getSubCategories')->where(['category_id' => '[0-9]+']);
});

//exams routes
Route::group(['prefix' => 'exams'], function () {
    Route::get('type/{category_id}', 'api\ExamTypeController@index')->where(['category_id' => '[0-9]+']);
    Route::post('type/add', 'api\ExamTypeController@store');
    Route::get('list_free/{category_id}', 'api\ExamController@listFree')->where(['category_id' => '[0-9]+']);
    Route::get('list_with_code/{category_id}/{code}', 'api\ExamController@listWithCode')->where(['category_id' => '[0-9]+']);
    Route::post('add', 'api\ExamController@store');
});

//questions routes
Route::group(['prefix' => 'question'], function () {
    Route::get('all/{exam_id}/{user_id}', 'api\ExamQuestionController@listQuestion')->where(['exam_id' => '[0-9]+','user_id' => '[0-9]+']);
});

//user progress routes
Route::group(['prefix' => 'question'], function () {
    Route::post('update_progress', 'api\UserProgressController@updateUserProgress');
});

//notifications routes
Route::group(['prefix' => 'notification'], function () {
    Route::get('list/{user_id?}', 'api\NotificationController@listNotification')->where(['user_id' => '[0-9]+']);
});
//link routes
Route::group(['prefix' => 'link'], function () {
    Route::get('list', 'api\UsefulLinkController@listLinks');
});

//link routes
Route::group(['prefix' => 'link'], function () {
    Route::get('list', 'api\UsefulLinkController@listLinks');
});

//suggestion routes
Route::group(['prefix' => 'suggestion'], function () {
    Route::post('add', 'api\SuggestionController@store');
});


//settings routes
Route::group(['prefix' => 'setting'], function () {
    Route::post('add', 'api\SettingController@store');
    Route::get('about_us', 'api\SettingController@aboutUs');
    Route::get('terms_and_conditions', 'api\SettingController@termsAndCondition');
    Route::get('social_links', 'api\SettingController@SocialLinks');
});
