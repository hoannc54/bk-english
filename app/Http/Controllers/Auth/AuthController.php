<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequests;
use App\Http\Requests\UserRequest;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

//    protected $redirectTo = '/admin';
    protected $redirectPath = '/home';

    protected $redirectAfterLogout = '/';
    protected $loginPath = 'login';

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar) {
        $this->auth = $auth;
        $this->registrar = $registrar;

//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getRegister() {
        return view('auth.register');
    }

    public function postRegister(UserRequest $request) {
//        $user = new User;
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = Hash::make($request->password);
//        $user->level = $request->level;
//        $user->remember_token = $request->_token;
//        $user->save();
        
//return $request->all();
        $this->auth->login($this->registrar->create($request->all()));

        return redirect($this->redirectPath());
        
//        return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getLogin() {
        return view('auth.login');
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
            return redirect()->route('getHome');
        } else {
            return redirect($this->loginPath())->withErrors([
                        'error' => $this->getFailedLoginMessage(),
            ]);
        }
    }

//    public function getLogout() {
//        
//    }
}
