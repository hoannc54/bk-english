<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Example;
use Illuminate\Http\Request;

class ExampleController extends Controller {

    public function index() {
        return redirect()->route('admin.example.getList');
    }

    public function getAdd() {
        return view('admin.example.add');
    }

    public function postAdd(Request $request) {
//        print_r($request->example);
        foreach ($request->example as $value) {
            $old_ex = Example::where('example', $value['sentence'])->count();
            if ($value['sentence'] != '' && $value['mean'] != '' && $old_ex == 0) {
                $example = new Example();
                $example->example = $value['sentence'];
                $example->mean = $value['mean'];
                $example->save();
                ex_to_word($example->id, $example->example);
            }
        }
        return redirect()->route('admin.example.getAdd')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getEdit($id) {
        $data = Example::find($id);
        if (!empty($data)) {
            return view('admin.example.edit', compact('data'));
        } else {
            return redirect()->route('admin.example.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy câu cần sửa!']);
        }
    }

    public function postEdit(Request $request, $id) {
        $example = Example::find($id);
        if (!empty($example)) {
            $old_ex = mb_convert_case(trim($example->example, '.?!'), MB_CASE_LOWER, 'utf-8');
            $new_ex = mb_convert_case(trim($request->example, '.?!'), MB_CASE_LOWER, 'utf-8');
            if (strcmp($old_ex, $new_ex) != 0) {
                $e = Example::where('example', $request->example)->count();
                if ($e > 0) {
                    return redirect()->route('admin.example.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi! Câu sửa bị trùng.']);
                }
                del_ex_word($id);
                ex_to_word($id, $new_ex);
                $example->example = $request->example;
            }
            $example->mean = $request->mean;
            $example->save();
            return redirect()->route('admin.example.getList')->with(['flash_level' => 'success', 'flash_message' => 'Sửa thành công!']);
        } else {
            return redirect()->route('admin.example.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy câu cần sửa!']);
        }
    }

    public function postDelete(Request $request) {
        $i = 0;
        if (is_string($request->ids)) {
            $list_examples = explode(' ', $request->ids);
            foreach ($list_examples as $ex_id) {
                $example = Example::find($ex_id);
                if (!empty($example) && strcmp($request->action, 'delete') == 0) {
                    del_ex_word($example->id);
                    $example->delete();
                    $i++;
                }
            }
            if ($i != 0) {
                return redirect()->route('admin.example.getList')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công ' . $i . ' mục!']);
            } else {
                return redirect()->route('admin.example.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không có gì để xóa!']);
            }
        } else {
            return redirect()->route('admin.example.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không thể xóa!']);
        }
    }

    public function getList() {
        $data = Example::get();
        return view('admin.example.list', compact('data'));
    }
    
    public function getListAjax() {
        $data = Example::get()->toJson();
        return '{"data":'.$data.'}';
    }

}
