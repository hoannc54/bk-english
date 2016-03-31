<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;

class UserController extends Controller {
    public function index() {
        return redirect()->route('admin.user.getList');
    }
    
    public function getList() {
        $data = User::select('id', 'name', 'email', 'level')->get();
        return view('admin.user.list', compact('data'));
    }
    
    public function getListAjax() {
        $data = User::select('id', 'name', 'email', 'level')->get()->toJson();
        return '{"data":'.$data.'}';
    }

    public function getAdd() {
        return view("admin.user.add");
    }

    public function postAdd(UserRequest $request) {
        $user = new User;
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password =Hash::make($request->password);
        $user->level =$request->level;
        $user->remember_token =$request->_token;
        $user->save();
        return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getEdit() {
        
    }

    public function postEdit() {
        
    }

    public function postDelete() {
        
    }

}
