<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\LoginRequests;
use Auth;

class AdminController extends AuthController {

//    public $redirectPath = '/admin';
//    protected $redirectTo = '/admin';

    public function index() {
        return view('admin.home');
    }

    public function getLogin() {
//        die();
        if (Auth::check() && Auth::user()->level==2) {
            return redirect()->route('admin.home');
        } else {
            return view('admin.login');
        }
    }

    public function getLogout() {
        $this->auth->logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : route('admin.getLogin'));
    }

    public function postLogin(LoginRequests $request) {
        $login = [
            'name' => $request->username,
            'password' => $request->password,
            'level' => 2
        ];
        if ($this->auth->attempt($login)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back();
//            echo 'ssss';
        }
    }

}
