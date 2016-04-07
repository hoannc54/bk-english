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
    return redirect()->route('getHome');
});
//Route::group(['middleware' => 'guest'], function () {
Route::get('home', ['as' => 'getHome', 'uses' => 'HomeController@index']);

Route::get('login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('admin/login', ['as' => 'admin.getLogin', 'uses' => 'Admin\AdminController@getLogin']);
Route::post('admin/login', ['as' => 'admin.postLogin', 'uses' => 'Admin\AdminController@postLogin']);
//});
//Route::get('home', 'HomeController@index');
//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
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

        Route::get('ex/{id?}', ['as' => 'admin.word.getExample', 'uses' => 'Admin\WordController@getExample']);

        Route::get('list', ['as' => 'admin.word.getList', 'uses' => 'Admin\WordController@getList']);
        Route::get('list/ajax', ['as' => 'admin.word.getListAjax', 'uses' => 'Admin\WordController@getListAjax']);

        Route::get('edit/{id}', ['as' => 'admin.word.getEdit', 'uses' => 'Admin\WordController@getEdit']);
        Route::post('edit', ['as' => 'admin.word.postEdit', 'uses' => 'Admin\WordController@postEdit']);
//        Route::post('edit/{id}', ['as' => 'admin.word.postEdit', 'uses' => 'Admin\WordController@postEdit']);

        Route::post('delete', ['as' => 'admin.word.postDelete', 'uses' => 'Admin\WordController@postDelete']);

        Route::post('postdel', ['as' => 'admin.word.postDel', 'uses' => 'Admin\WordController@postDel']);
    });

    Route::group(['prefix' => 'example'], function() {

        Route::get('/', ['as' => 'admin.example', 'uses' => 'Admin\ExampleController@index']);

        Route::get('add', ['as' => 'admin.example.getAdd', 'uses' => 'Admin\ExampleController@getAdd']);
        Route::post('add', ['as' => 'admin.example.postAdd', 'uses' => 'Admin\ExampleController@postAdd']);

        Route::get('list', ['as' => 'admin.example.getList', 'uses' => 'Admin\ExampleController@getList']);
        Route::get('list/ajax', ['as' => 'admin.example.getListAjax', 'uses' => 'Admin\ExampleController@getListAjax']);

        Route::get('edit/{id}', ['as' => 'admin.example.getEdit', 'uses' => 'Admin\ExampleController@getEdit']);
        Route::post('edit', ['as' => 'admin.example.postEdit', 'uses' => 'Admin\ExampleController@postEdit']);
//        Route::post('edit/{id}', ['as' => 'admin.example.postEdit', 'uses' => 'Admin\ExampleController@postEdit']);

        Route::post('delete', ['as' => 'admin.example.postDelete', 'uses' => 'Admin\ExampleController@postDelete']);

        Route::post('postdel', ['as' => 'admin.example.postDel', 'uses' => 'Admin\ExampleController@postDel']);
    });

    Route::group(['prefix' => 'user'], function() {

        Route::get('/', ['as' => 'admin.user', 'uses' => 'Admin\UserController@index']);

        Route::get('add', ['as' => 'admin.user.getAdd', 'uses' => 'Admin\UserController@getAdd']);
        Route::post('add', ['as' => 'admin.user.postAdd', 'uses' => 'Admin\UserController@postAdd']);

        Route::get('list', ['as' => 'admin.user.getList', 'uses' => 'Admin\UserController@getList']);
        Route::get('list/ajax', ['as' => 'admin.user.getListAjax', 'uses' => 'Admin\UserController@getListAjax']);

//        Route::get('edit/{id}', ['as' => 'admin.user.getEdit', 'uses' => 'Admin\UserController@getEdit']);
        Route::post('edit', ['as' => 'admin.user.postEdit', 'uses' => 'Admin\UserController@postEdit']);

        Route::post('delete', ['as' => 'admin.user.postDel', 'uses' => 'Admin\UserController@postDel']);
    });
});

//Route::post('/post', function (\Illuminate\Http\Request $request){
//    $data = $request->;
//    return view('post',  compact());
//});