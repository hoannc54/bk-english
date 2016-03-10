<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Word;

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
        $word->sound = 'public/sound/' . $request->word . '.mp3';
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
                    $chil_word->parent_id = $word_parent;
                    $chil_word->save();

                    word_to_ex($chil_word->id, $chil_word->word);
                }
            }
        }
        return redirect()->route('admin.word.getAdd')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getList() {
        $data = Word::select('id', 'word', 'spell', 'mean', 'sound', 'parent_id')->orderBy('word', 'ASC')->get();
        return view('admin.word.list', compact('data'));
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

    public function postEdit(Request $request, $id) {
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
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Sửa thành công!']);
        } else {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy từ cần sửa!']);
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
        echo $request->ids;
        if ($i != 0) {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công ' . $i . ' mục!']);
        } else {
            return redirect()->route('admin.word.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Không có gì để xóa.']);
        }
    }

}
