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
    return redirect('admin/login');
});

Route::get('/home', function () {
    return redirect('admin/home');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('/change-locale', function (){
    app()->setLocale(config('app.locale'));
    return redirect('admin/login');
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('locale', function () {
    return \App::getLocale();
});

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    app()->setLocale($locale);
    return redirect('locale');
});

Route::group(['namespace' => 'Backend', 'as' => 'backend.', 'prefix' => 'admin','middleware' => ['language']], function () {

    Route::Auth();

    Route::group(["middleware" => "auth"], function () {
        Route::get('/home','DashboardController@index')->name('dashboard');

        Route::resource('category','CategoriesController',[
            'names' => [
                'index' => 'category',
                'update' => 'category.update',
            ]
        ]);

        Route::resource('exam-type','ExamTypeController',[
            'names' => [
                'index' => 'exam-type',
            ]
        ]);

        Route::resource('questions','QuestionController',[
          'names' => [
              'index' => 'questions',
              'create' => 'questions.create'
          ]
        ]);
    });
});