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



    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'api\AuthController@login');
        Route::post('activate', 'api\AuthController@activateAccount');
        Route::post('signup', 'api\AuthController@signup')->middleware('unwrapFromJson');
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
    Route::get('all/{exam_id}', 'api\ExamQuestionController@listQuestion')->where(['exam_id' => '[0-9]+']);
});
