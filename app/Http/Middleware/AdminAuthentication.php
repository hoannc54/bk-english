<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Auth;

class AdminAuthentication {

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            if ($this->auth->user()->level == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return new RedirectResponse(route('admin.getLogin'));
            }
        } else {
            return new RedirectResponse(route('admin.getLogin'));
        }
    }

}
