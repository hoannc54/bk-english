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

Route::group(['prefix' => 'admin'], function () {
//    Route::get('login', function(){
//       return view('admin.login');
//    });
    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);
    
    Route::get('login', ['as' => 'admin.getLogin', 'uses' => 'AdminController@getLogin']);
    Route::post('login', ['as' => 'admin.postLogin', 'uses' => 'AdminController@postLogin']);
    
    Route::group(['prefix' => 'words'], function() {
        Route::get('/', ['as' => 'admin.word', 'uses' => 'WordController@index']);
        
        Route::get('add', ['as' => 'admin.word.getAdd', 'uses' => 'WordController@getAdd']);
        Route::post('add', ['as' => 'admin.word.postAdd', 'uses' => 'WordController@postAdd']);
        
        Route::get('list', ['as' => 'admin.word.getList', 'uses' => 'WordController@getList']);
        
        Route::get('edit/{id}', ['as' => 'admin.word.getEdit', 'uses' => 'WordController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.word.postEdit', 'uses' => 'WordController@postEdit']);
        
        Route::post('delete', ['as' => 'admin.word.postDelete', 'uses' => 'WordController@postDelete']);
    });
    
    Route::group(['prefix' => 'example'], function() {
        
        Route::get('/', ['as' => 'admin.example', 'uses' => 'ExampleController@index']);
        
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