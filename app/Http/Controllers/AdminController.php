<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;

class AdminController extends Controller {
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index() {
        return view('admin.home');
        
    }
    
    public function getLogin() {
        return view('admin.login');
    }
    
    public function postLogin(Request $request) {
        echo $request->user;
        echo $request->pass;
    }

}
