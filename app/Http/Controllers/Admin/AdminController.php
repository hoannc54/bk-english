<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\LoginRequests;

class AdminController extends AuthController {

//    public $redirectPath = '/admin';
//    public $redirectTo = '/admin';
    
    public function index() {
        return view('admin.home');
    }

    public function getLogin() {
        return view('admin.login');
    }

    public function postLogin(LoginRequests $request) {
        $login = [
            'name' => $request->username,
            'password' => $request->password,
            'level' => 2
        ];
        if ($this->auth->attempt($login)) {
            return redirect()->route('admin');
        } else {
            return redirect()->back();
//            echo 'ssss';
        }
    }

}
