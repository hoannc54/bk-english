<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
//use App\Http\Controllers\Auth\AuthController;
//use App\Http\Requests\LoginRequests;
use Auth;
//class AdminController extends AuthController {
//
////    public $redirectPath = '/admin';
////    protected $redirectTo = '/admin';
//    protected $redirectAfterLogout = 'admin/login';
//
//    public function index() {
//        return view('admin.home');
//    }
//
//    public function getLogin() {
////        die();
//        if (Auth::check() && Auth::user()->level == 1) {
//            return redirect()->route('admin.home');
//        } else {
//            return view('admin.login');
//        }
//    }
//
////    public function getLogout() {
////        $this->auth->logout();
////        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : route('admin.getLogin'));
////    }
//
//    public function postLogin(LoginRequests $request) {
//        $login = [
//            'name' => $request->username,
//            'password' => $request->password
////            'level' => $request->level
//        ];
//        if ($this->auth->attempt($login)) {
//            return redirect()->route('admin.home');
//        } else {
//            return redirect()->back();
////            echo 'ssss';
//        }
//    }
//
//}
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequests;

class AdminController extends Controller {

//    protected $redirectTo = '/admin';
//    protected $redirectPath = '/admin';

    protected $redirectAfterLogout = 'admin/login';
    protected $loginPath = 'admin/login';

    use AuthenticatesAndRegistersUsers;

    public function __construct(Guard $auth, Registrar $registrar) {
        $this->auth = $auth;
        $this->registrar = $registrar;

//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function index() {
        return view('admin.home');
    }

    public function getLogin() {
        if (Auth::check()) {
            if (Auth::user()->level == 1) {
                return redirect()->route('admin.home');
            } else {
                Auth::logout();
                return view('admin.login');
            }
        } else {
            return view('admin.login');
        }
    }

    public function postLogin(LoginRequests $request) {
        $login = [
            'name' => $request->username,
            'password' => $request->password
        ];
        if ($this->auth->attempt($login)) {
            return redirect()->route('admin.home');
        } else {
            return redirect($this->loginPath())->withErrors([
                            'email' => $this->getFailedLoginMessage(),
        ]);
        }
    }

}
