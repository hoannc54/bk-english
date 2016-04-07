<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Auth;

class AdminAuthentication {

    protected $auth;
    protected $message = 'Bạn cần đăng nhập với tài khoản admin.';

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            if ($this->auth->user()->level == 1 || $this->auth->user()->level == 2) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect(route('admin.getLogin'))->withErrors([
                            'error' => $this->message,
        ]);
            }
        } else {
            return redirect(route('admin.getLogin'));
        }
    }

}
