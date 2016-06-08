<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use File;
use App\Word;
use App\Learned;
use App\Learning;
use App\NotLearn;

class LearnController extends Controller {

//    Auth::user()->id;

    protected function addLearned() {
        $learned = new Learned;
        $learned->user_id = Auth::user()->id;
        $learned->word_id_list = '';
        $learned->save();
        return $learned;
    }

    protected function addNotLearn() {
        $words = Word::get();
        $id_list = '';
        foreach ($words as $value) {
            $id_list .= ' ' . $value->id;
        }
//                $id_list = trim($id_list);
        $notLearn = new NotLearn;
        $notLearn->user_id = Auth::user()->id;
        $notLearn->word_id_list = trim($id_list);
        $notLearn->save();
        return $notLearn;
    }

    protected function addLearning($w_id) {
        $learning = new Learning();
        $learning->user_id = Auth::user()->id;
        $learning->word_id = $w_id;
        $learning->learn_counts = 0;
        $learning->point = 0;
        $learning->save();
    }

    protected function findWordAndExample($w_id) {
        $word = Word::find($w_id);
        if (!$word) {
            return FALSE;
        }

//        $ex = $word->examples()->get()->toArray();
        $a_word = $word->toArray();
//        if (empty($ex)) {
//            $a_word['example'] = '';
//        } else {
//            $a_word['examples'] = $ex;
//        }

        if (File::exists('public/images/words/' . $a_word['image'])) {
            $a_word['image'] = url('public/images/words/' . $a_word['image']);
        } else {
            $a_word['image'] = url('public/images/words/no_img.jpg');
        }
        $a_word['sound'] = url('public/sounds/' . $a_word['sound']);
        return $a_word;
    }

    public function getLearningAjax() {
        $learnings = Learning::where('user_id', Auth::user()->id)->get();

        //Kiểm tra điểm của các từ đang học
        //Nếu đủ điểm thì thêm vào các từ đã học xong
        //Nếu từ không tồn tại thì xóa
        $learnedData = Learned::where('user_id', Auth::user()->id)->first();
        if (!$learnedData) {
            $learnedData = $this->addLearned();
        }
        $w_t = [];
        foreach ($learnings as $key => $value) {
            //Nếu từ đã tồn tại trong mảng TỪ ĐANG HỌC thì loại bỏ và tiếp tục
            if (in_array($value->word_id, $w_t)) {
                $value->delete();
                unset($learnings[$key]);
                continue;
            }

            $w = Word::find($value->word_id);

            //Nếu không tồn tại TỪ thì xóa đi và tiếp tục
            if (!$w) {
                $value->delete();
                unset($learnings[$key]);
                continue;
            }

            //Nếu số lần học nhở hơn 4 thì tiếp tục
            if ($value->learn_counts < 4) {
                $w_t[] = $value->word_id;
                continue;
            }

            $diem = $value->point * 100 / $value->learn_counts;

            if ($diem > 80) {
                $learnedData->word_id_list .= ' ' . $value->word_id;
                $value->delete();
                unset($learnings[$key]);
            } else {
                $w_t[] = $value->word_id;
            }
        }
        $learnedData->word_id_list = trim($learnedData->word_id_list);
        $learnedData->save();


        //Nếu số từ cần học < 5 thì thêm từ mới vào
        $num_add = 5 - count($learnings);
        if ($num_add > 0) {
            $word_data = NotLearn::where('user_id', Auth::user()->id)->first();

            //Nếu không tồn tại NotLearn thì thêm mới
            if (!$word_data) {
                $word_data = $this->addNotLearn();
            }

            $word_ids = explode(' ', $word_data->word_id_list);

            for ($i = 0; $i < $num_add; $i++) {
                do {
                    $word_id = array_shift($word_ids);
                    $word = Word::find($word_id);
                } while (empty($word) && count($word_ids) > 0 && $word_id == NULL);

                if (empty($word)) {
                    break;
                }

                $this->addLearning($word_id);
            }
            $word_data->word_id_list = implode(' ', $word_ids);
            $word_data->save();

            //truy vấn lại để lấy danh sách từ mới
            $learnings = Learning::where('user_id', Auth::user()->id)->get();
        }

        $arr_word = [];

        foreach ($learnings as $value) {
            $a_w = $this->findWordAndExample($value->word_id);
            if (!empty($a_w)) {
                $arr_word[] = $a_w;
            }
        }


        $json_word = json_encode($arr_word);

        if ($json_word == '') {
            $json_word = '[]';
        }

        return $json_word;
    }

    public function getLearnedAjax() {
        $data = Learned::where('user_id', Auth::user()->id)->first();
        if (!$data) {
            $data = $this->addLearned();
        }
        $json_word = '';
//        print_r($data->word_id_list);
        if (!empty($data->word_id_list)) {
            $word_ids = explode(' ', $data->word_id_list);
//        print_r($word_ids);
//        $wordAjax = '';
            $ar_data = [];
            foreach ($word_ids as $value) {
                $a_word = $this->findWordAndExample($value);
                if ($a_word) {
                    $ar_data[] = $a_word;
                }
            }
            $json_word = json_encode($ar_data);
        }
        if ($json_word == '') {
            $json_word = '[]';
        }
        return $json_word;
    }

    public function getNotLearnAjax() {
        $data = NotLearn::where('user_id', Auth::user()->id)->first();
        if (!$data) {
            $this->addNotLearn();
        }

        $json_word = '';
        if (!empty($data->word_id_list)) {
            $word_ids = explode(' ', $data->word_id_list);
            $ar_data = [];
            foreach ($word_ids as $value) {
                $a_word = $this->findWordAndExample($value);
                if ($a_word) {
                    $ar_data[] = $a_word;
                }
            }
            $json_word = json_encode($ar_data);
        }
        if ($json_word == '') {
            $json_word = '[]';
        }
        return $json_word;
    }

    //dang hoc
    public function getLearning() {
        return view('learn.dang-hoc');
    }

    //da hoc thuoc
    public function getLearned() {
        return view('learn.da-hoc');
    }

    //chua hoc
    public function getNotLearn() {
        return view('learn.chua-hoc');
    }

    //Cập nhật từ đang học
    public function postLearningUpdate(Request $request) {
        if ($request->id != '') {
            $id = (int) $request->id;
            $kq = (int) $request->kq;
            $l = Learning::where('word_id', $id)->where('user_id', Auth::user()->id)->first();

            if ($l && $l->user_id == Auth::user()->id) {
                $l->learn_counts++;
                if ($kq) {
                    $l->point++;
                }

                $l->save();
                return '{"status":"success", "message":"Cập nhật thành công!"}';
            }
        }

        return '{"status":"error", "message":"Đã có lỗi cập nhật!"}';
    }

    public function postTestUpdate(Request $request) {
        if ($request->id != '') {
            $id = (int) $request->id;
//            $kq = (boolean) $request->kq;

            $learned = Learned::where('user_id', Auth::user()->id)->first();
            $notLearn = NotLearn::where('user_id', Auth::user()->id)->first();

//            $l = Learning::where('word_id', $id)->where('user_id', Auth::user()->id)->first();
//            if ($l && $l->user_id == Auth::user()->id) {
//            $arr_learned = $l->learn_counts++;
//            if ($kq) {
//                $l->point++;
//            }

            if (!empty($learned->word_id_list)) {
                $arr_learned = explode(' ', $learned->word_id_list);
//                $l->save();
                $key = array_search($id, $arr_learned);
                if ($key !== FALSE) {
                    unset($arr_learned[$key]);
                    $notLearn->word_id_list = $id . ' ' . $notLearn->word_id_list;
                    $learned->word_id_list = implode(' ', $arr_learned);


                    $learned->word_id_list = trim($learned->word_id_list);
                    $notLearn->word_id_list = trim($notLearn->word_id_list);
                    $learned->save();
                    $notLearn->save();
//                }
                    return '{"status":"success", "message":"Cập nhật thành công!"}';
                }
            }
        }

        return '{"status":"error", "message":"Đã có lỗi cập nhật!"}';
    }

}
