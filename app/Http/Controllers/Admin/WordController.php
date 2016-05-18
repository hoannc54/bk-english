<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Word;

//use JSON;

class WordController extends Controller {

    public function index() {
        return redirect()->route('admin.word.getList');
    }

    public function getAdd() {
        return view('admin.word.add');
    }

    public function postAdd(WordRequest $request) {
        $word = new Word();
        $word->word = $request->word;
        $word->spell = $request->spell;
        $word->mean = $request->means;
        $word->type = '';
        if (is_array($request->type)) {
            foreach ($request->type as $va) {
                $word->type .= ' ' . $va;
            }
        }
        $word->type = trim($word->type);
        $word->sound = 'public/sounds/' . $request->word . '.mp3';
        $word->image = 'public/images/words/' . $request->word . '.jpg';
        $word->parent_id = 0;
        $word->save();
        word_to_ex($word->id, $word->word);

        $word_parent = $word->id;
        if ($request->check_list == TRUE) {
            foreach ($request->chil as $chil) {
                if ($chil['word'] != '' && $chil['spell'] != '' && $chil['means'] != '') {
                    $chil_word = new Word();
                    $chil_word->word = $chil['word'];
                    $chil_word->spell = $chil['spell'];
                    $chil_word->mean = $chil['means'];
                    $chil_word->type = '';
                    if (is_array($chil['type'])) {
                        foreach ($chil['type'] as $va) {
                            $chil_word->type .= ' ' . $va;
                        }
                    }
                    $chil_word->type = trim($chil_word->type);
                    $chil_word->sound = 'public/sounds/' . $chil_word->word . '.mp3';
                    $chil_word->image = 'public/images/words/' . $chil_word->word . '.jpg';
                    $chil_word->parent_id = $word_parent;
                    $chil_word->save();

                    word_to_ex($chil_word->id, $chil_word->word);
                }
            }
        }
        return redirect()->route('admin.word.getAdd')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getList() {
        $data = Word::select('id', 'word', 'spell', 'mean', 'sound', 'image', 'parent_id')->orderBy('word', 'ASC')->get();
        return view('admin.word.list', compact('data'));
    }

    public function getListAjax() {

//        $data = Word::get()->toArray();
//        foreach ($data as &$word) {
//            $p_word = Word::find($word['parent_id']);
//            if (!empty($p_word)) {
//                $word['parent_word'] = $p_word->word;
//            } else {
//                $word['parent_word'] = 'none';
//            }
//        }
//        $json_word = json_encode($data);
////        print_r($data2);
//        return '{"data":' . $json_word . '}';

        $ar_data = [];
        $data = Word::get();
        foreach ($data as $word) {
            $da = $word->examples()->get()->toArray();
            $a_word = $word->toArray();
            $p_word = Word::find($word->parent_id);
            if (!empty($p_word)) {
                $a_word['parent_word'] = $p_word->word;
            } else {
                $a_word['parent_word'] = 'none';
            }
            if (empty($da)) {
                $a_word['example'] = '';
            } else {
                $a_word['examples'] = $da;
            }
            $ar_data[] = $a_word;
        }
        $json_word = json_encode($ar_data);
//        print_r($data2);
        return '{"data":' . $json_word . '}';
    }

    public function getExample($id = NULL) {
        $word = Word::find($id);
        if (!empty($word)) {
            $exs = $word->examples()->get()->toArray();
            if (empty($exs)) {
                return NULL;
            } else {
//                echo '<span>';
                return $exs;
            }
        } else {
            return NULL;
        }
    }

    public function getEdit($id) {
//        echo $id;
        $data = Word::find($id);
        if (!empty($data)) {
            $parent = Word::find($data->parent_id);
//            print_r($parent);
            return view('admin.word.edit', compact('data', 'parent'));
        } else {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy từ cần sửa!']);
        }
    }

    public function postEdit2(Request $request, $id) {
        $word = Word::find($id);

        if (!empty($word)) {
            $old_word = mb_convert_case($word->word, MB_CASE_LOWER, 'utf-8');
            $new_word = mb_convert_case($request->word, MB_CASE_LOWER, 'utf-8');
//            $word->word = $request->word;
            if (strcmp($old_word, $new_word) != 0) {
                $w = Word::where('word', $new_word)->count();
                if ($w > 0) {
                    return redirect()->route('admin.word.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi! Từ sửa bị trùng.']);
                }
                del_word_ex($id);
                word_to_ex($id, $new_word);
                $word->word = $new_word;
            }
            $word->spell = $request->spell;
            $word->type = '';
            if (is_array($request->type)) {
                foreach ($request->type as $va) {
                    $word->type .= ' ' . $va;
                }
            }
            $word->type = trim($word->type);
            $word->mean = $request->means;
            $word->save();

            if (trim($request->parent) != '') {
                $word_parent = Word::where('word', trim($request->parent))->first();
                if (!empty($word_parent)) {
                    if ($word_parent->parent_id == 0) {
                        $word->parent_id = $word_parent->id;
                    } else {
                        return redirect()->route('admin.word.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi! Từ gốc là từ con của 1 từ khác.']);
                    }
                } else {
                    $word->parent_id = 0;
                    return redirect()->route('admin.word.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi! Từ gốc không tồn tại.']);
                }
                $word->save();
            }
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'success', 'flash_message' => 'Sửa thành công!']);
        } else {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy từ cần sửa!']);
        }
    }

    public function postEdit(Request $request) {
        $word = Word::find($request->id);

        if (!empty($word)) {
            $old_word = mb_convert_case($word->word, MB_CASE_LOWER, 'utf-8');
            $new_word = mb_convert_case($request->word, MB_CASE_LOWER, 'utf-8');
//            $word->word = $request->word;
            if (strcmp($old_word, $new_word) != 0) {
                $w = Word::where('word', $new_word)->count();
                if ($w > 0) {
                    return '{"status" : "danger", "message" : "Lỗi! Từ sửa bị trùng."}';
//                    return redirect()->route('admin.word.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi! Từ sửa bị trùng.']);
                } else {
                    del_word_ex($request->id);
                    word_to_ex($request->id, $new_word);
                    $word->word = $new_word;
                }
            }
            $word->spell = $request->spell;
            $word->type = '';
            if (is_array($request->type)) {
                foreach ($request->type as $va) {
                    $word->type .= ' ' . $va;
                }
            }
            $word->type = trim($word->type);
            $word->mean = $request->means;
            $word->save();

            if (trim($request->parent) != '') {
                $word_parent = Word::where('word', trim($request->parent))->first();
                if (!empty($word_parent)) {
                    if ($word_parent->parent_id == 0) {
                        $word->parent_id = $word_parent->id;
                    } else {
                        return '{"status" : "danger", "message" : "Lỗi! Từ gốc là từ con của 1 từ khác."}';
//                        return redirect()->route('admin.word.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi! Từ gốc là từ con của 1 từ khác.']);
                    }
                } else {
                    $word->parent_id = 0;
                    return '{"status" : "danger", "message" : "Lỗi! Từ gốc không tồn tại."}';
//                    return redirect()->route('admin.word.getEdit', $id)->with(['flash_level' => 'danger', 'flash_message' => '']);
                }
                $word->save();
            }
            return '{"status" : "success", "message" : "Sửa thành công!"}';
        } else {
            return '{"status" : "danger", "message" : "Không tìm thấy từ cần sửa!"}';
        }
    }

    public function postDelete(Request $request) {
        $i = 0;
        if (is_string($request->ids) && strcmp($request->action, 'delete') == 0) {
            $list_w = explode(' ', $request->ids);
//            print_r($list_w);
            foreach ($list_w as $w_id) {
                if ($w_id != NULL) {
                    $chil = Word::where('parent_id', $w_id)->get();
                    if ($chil->count() > 0) {
//            print_r($chil);
                        foreach ($chil as $value) {
                            del_word_ex($value->id);
                            $value->delete();
                        }
                    }
                    $word = Word::find($w_id);
                    if (!empty($word)) {
                        del_word_ex($word->id);
                        $word->delete();
                        $i++;
                    }
                }
            }
        }
//        echo $request->ids;
        if ($i != 0) {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công ' . $i . ' mục!']);
        } else {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không có gì để xóa.']);
        }
    }

    public function postDel(Request $request) {
        $i = 0;
        if (is_string($request->ids) && strcmp($request->action, 'delete') == 0) {
            $list_w = explode(' ', $request->ids);
            foreach ($list_w as $w_id) {
                if ($w_id != NULL) {
                    $chil = Word::where('parent_id', $w_id)->get();
                    if ($chil->count() > 0) {
                        foreach ($chil as $value) {
                            del_word_ex($value->id);
                            $value->delete();
                        }
                    }
                    $word = Word::find($w_id);
                    if (!empty($word)) {
                        del_word_ex($word->id);
                        $word->delete();
                        $i++;
                    }
                }
            }
        }
//        echo $request->ids;
//        echo $request->action;
        if ($i != 0) {
            return '{"status":"success", "message":"Xóa thành công ' . $i . ' mục!"}';
        } else {
            return '{"status":"danger", "message":"Không có gì để xóa."}';
        }
    }

}
