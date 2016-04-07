<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Auth;
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
        return '{"data":' . $data . '}';
    }

    public function getAdd() {
        return view("admin.user.add");
    }

    public function postAdd(UserRequest $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->remember_token = $request->_token;
        $user->save();
        return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

//    public function getEdit() {
//        
//    }

    public function postEdit(Request $request) {
        $user = User::find($request->id);
//return '{"status" : "success", "message" : "Sửa thành công!"}';
        //Nếu user tồn tại
        if (!empty($user)) {

            //Nếu user có level < user cần sửa thì ko được sửa thành viên đó
            if (Auth::user()->level > $user->level) {
                return '{"status" : "danger", "message" : "Bạn không thể sửa thành viên cấp cao hơn."}';
            } else {
                $old_email = trim(mb_convert_case($user->email, MB_CASE_LOWER, 'utf-8'));
                $new_email = trim(mb_convert_case($request->email, MB_CASE_LOWER, 'utf-8'));
                if (strcmp($old_email, $new_email) != 0) {
                    $w = User::where('email', $new_email)->count();
                    if ($w > 0) {
                        return '{"status" : "danger", "message" : "Lỗi! Email đã được dùng."}';
                    } else {
                        $user->email = $new_email;
                        $user->save();
                    }
                }

                //Không cho phép người dùng sửa lên cấp cao hơn cấp hiện tại
                if (Auth::user()->level <= $request->level) {
                    $user->level = $request->level;
                    $user->save();
                } else {
                    return '{"status" : "danger", "message" : "Bạn không thể sửa thành viên lên cấp cao hơn."}';
                }

                return '{"status" : "success", "message" : "Sửa thành công!"}';
            }

            //Nếu user không tồn tại
        } else {
            return '{"status" : "danger", "message" : "Không tìm thấy thành viên cần sửa!"}';
        }
    }

    public function postDel(Request $request) {
        $i = 0;
        $j = 0;
        if (is_string($request->ids) && strcmp($request->action, 'delete') == 0) {
            $list_user = explode(' ', $request->ids);
            foreach ($list_user as $user) {
                $user =(int)$user;
                if ($user != null) {
                    if ($user != Auth::user()->id) {
                        $u = User::find($user);
                        if (!empty($u)) {
                            if (Auth::user()->level <= $u->level) {
                                $u->delete();
                                $i++;
                            } else {
                                $j++;
                            }
                        }
                    } else {
                        $j++;
                    }
                }
            }
        }

        if ($j != 0) {
            $kx = '<br/>Bạn không thể xóa ' . $j . ' mục.';
        } else {
            $kx = '';
        }

        if ($i != 0) {
            return '{"status":"success", "message":"Xóa thành công ' . $i . ' mục!' . $kx . '"}';
        } else {
            return '{"status":"danger", "message":"Không có gì để xóa.' . $kx . '"}';
        }
    }

}
