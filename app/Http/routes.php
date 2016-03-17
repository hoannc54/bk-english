<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('login');
});

Route::get('home', 'HomeController@index');

//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);

Route::get('admin/login', ['as' => 'admin.getLogin', 'uses' => 'Admin\AdminController@getLogin']);
Route::post('admin/login', ['as' => 'admin.postLogin', 'uses' => 'Admin\AdminController@postLogin']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
//    Route::get('login', function(){
//       return view('admin.login');
//    });
    Route::get('/home', ['as' => 'admin.home', 'uses' => 'Admin\AdminController@index']);

    Route::get('/logout', ['as' => 'admin.getLogout', 'uses' => 'Admin\AdminController@getLogout']);

    Route::get('/', function() {
        return redirect()->route('admin.home');
    });

    Route::group(['prefix' => 'words'], function() {
        Route::get('/', ['as' => 'admin.word', 'uses' => 'Admin\WordController@index']);

        Route::get('add', ['as' => 'admin.word.getAdd', 'uses' => 'Admin\WordController@getAdd']);
        Route::post('add', ['as' => 'admin.word.postAdd', 'uses' => 'Admin\WordController@postAdd']);

        Route::get('examples/{id?}', ['as' => 'admin.word.getExample', 'uses' => 'Admin\WordController@getExample']);

        Route::get('list', ['as' => 'admin.word.getList', 'uses' => 'Admin\WordController@getList']);
        Route::get('list/ajax', ['as' => 'admin.word.getListAjax', 'uses' => 'Admin\WordController@getListAjax']);

        Route::get('edit/{id}', ['as' => 'admin.word.getEdit', 'uses' => 'Admin\WordController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.word.postEdit', 'uses' => 'Admin\WordController@postEdit']);

        Route::post('delete', ['as' => 'admin.word.postDelete', 'uses' => 'Admin\WordController@postDelete']);
    });

    Route::group(['prefix' => 'example'], function() {

        Route::get('/', ['as' => 'admin.example', 'uses' => 'Admin\ExampleController@index']);

        Route::get('add', ['as' => 'admin.example.getAdd', 'uses' => 'Admin\ExampleController@getAdd']);
        Route::post('add', ['as' => 'admin.example.postAdd', 'uses' => 'Admin\ExampleController@postAdd']);

        Route::get('list', ['as' => 'admin.example.getList', 'uses' => 'Admin\ExampleController@getList']);
        Route::get('list/ajax', ['as' => 'admin.example.getListAjax', 'uses' => 'Admin\ExampleController@getListAjax']);

        Route::get('edit/{id}', ['as' => 'admin.example.getEdit', 'uses' => 'Admin\ExampleController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.example.postEdit', 'uses' => 'Admin\ExampleController@postEdit']);

        Route::post('delete', ['as' => 'admin.example.postDelete', 'uses' => 'Admin\ExampleController@postDelete']);
    });

    Route::group(['prefix' => 'user'], function() {

        Route::get('/', ['as' => 'admin.user', 'uses' => 'Admin\UserController@index']);

        Route::get('add', ['as' => 'admin.user.getAdd', 'uses' => 'Admin\UserController@getAdd']);
        Route::post('add', ['as' => 'admin.user.postAdd', 'uses' => 'Admin\UserController@postAdd']);

        Route::get('list', ['as' => 'admin.user.getList', 'uses' => 'Admin\UserController@getList']);
        Route::get('list/ajax', ['as' => 'admin.user.getListAjax', 'uses' => 'Admin\UserController@getListAjax']);

        Route::get('edit/{id}', ['as' => 'admin.user.getEdit', 'uses' => 'Admin\UserController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.user.postEdit', 'uses' => 'Admin\UserController@postEdit']);

        Route::post('delete', ['as' => 'admin.user.postDelete', 'uses' => 'Admin\UserController@postDelete']);
    });
});

Route::get('/abc', function () {
    return view('admin_test.template');
});
//Route::post('/post', function (\Illuminate\Http\Request $request){
//    $data = $request->;
//    return view('post',  compact());
//});