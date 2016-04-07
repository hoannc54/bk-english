<?php

namespace App\Http\Controllers\Admin;
use Auth;
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
    protected function getFailedLoginMessage() {
        return 'Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng nhập lại!';
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
                            'error' => $this->getFailedLoginMessage(),
        ]);
        }
    }

}
