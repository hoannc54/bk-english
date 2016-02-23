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

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin'], function () {
//    Route::get('/', function(){
//        view('admin.home');
//    });
    Route::get('login', ['as' => 'admin.login', 'uses' => 'AdminController@login']);
    Route::group(['prefix' => 'words'], function() {
        Route::get('add', ['as' => 'admin.word.getAdd', 'uses' => 'wordController@getAdd']);
        Route::post('add', ['as' => 'admin.word.postAdd', 'uses' => 'wordController@postAdd']);
        
        Route::get('list', ['as' => 'admin.word.getList', 'uses' => 'wordController@getList']);
        
        Route::get('edit/{id}', ['as' => 'admin.word.getEdit', 'uses' => 'wordController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.word.postEdit', 'uses' => 'wordController@postEdit']);
        
        Route::get('delete/{id}', ['as' => 'admin.word.getDelete', 'uses' => 'wordController@getDelete']);
    });
    
    Route::group(['prefix' => 'example'], function() {
        Route::get('add', ['as' => 'admin.example.getAdd', 'uses' => 'ExampleController@getAdd']);
        Route::post('add', ['as' => 'admin.example.postAdd', 'uses' => 'ExampleController@postAdd']);
        
        Route::get('list', ['as' => 'admin.example.getList', 'uses' => 'ExampleController@getList']);
        
        Route::get('edit/{id}', ['as' => 'admin.example.getEdit', 'uses' => 'ExampleController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.example.postEdit', 'uses' => 'ExampleController@postEdit']);
        
        Route::post('delete', ['as' => 'admin.example.postDelete', 'uses' => 'ExampleController@postDelete']);
    });
});

Route::get('abc', function (){
    return view('abc');   
});