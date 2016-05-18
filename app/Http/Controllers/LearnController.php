<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Word;
use App\Learned;
use App\Learning;
use App\NotLearn;

class LearnController extends Controller {

//    Auth::user()->id;

    public function getLearningAjax() {
        $data = Learning::where('user_id', Auth::user()->id)->get();
        $json_word = '';
//        print_r($data->word_id_list);
        if (!empty($data)) {
//            $word_ids = explode(' ', $data->word_id_list);
//        print_r($word_ids);
//        $wordAjax = '';
            $ar_data = [];
            foreach ($data as $value) {
                $word = Word::where('id', $value->word_id)->first();
                $ex = $word->examples()->get()->toArray();
                $a_word = $word->toArray();
                $a_value = $value->toArray();
                if (empty($ex)) {
                    $a_value['example'] = '';
                } else {
                    $a_value['examples'] = $ex;
                }
                $a_value['word'] = $a_word;
                $ar_data[] = $a_value;
            }
            $json_word = json_encode($ar_data);
//        print_r($data2);
        }
        return '{"data":' . $json_word . '}';
    }

    public function getLearnedAjax() {
        $data = Learned::where('user_id', Auth::user()->id)->first();
        $json_word = '';
//        print_r($data->word_id_list);
        if (!empty($data->word_id_list)) {
            $word_ids = explode(' ', $data->word_id_list);
//        print_r($word_ids);
//        $wordAjax = '';
            $ar_data = [];
            foreach ($word_ids as $value) {
                $word = Word::where('id', $value)->first();
                $ex = $word->examples()->get()->toArray();
                $a_word = $word->toArray();
                if (empty($ex)) {
                    $a_word['example'] = '';
                } else {
                    $a_word['examples'] = $ex;
                }
                $ar_data[] = $a_word;
            }
            $json_word = json_encode($ar_data);
//        print_r($data2);
        }
        return '{"data":' . $json_word . '}';
    }

    public function getNotLearnAjax() {
        $data = NotLearn::where('user_id', Auth::user()->id)->first();
        $json_word = '';
//        print_r($data->word_id_list);
        if (!empty($data->word_id_list)) {
            $word_ids = explode(' ', $data->word_id_list);
//        print_r($word_ids);
//        $wordAjax = '';
            $ar_data = [];
            foreach ($word_ids as $value) {
                $word = Word::where('id', $value)->first();
                $ex = $word->examples()->get()->toArray();
                $a_word = $word->toArray();
                if (empty($ex)) {
                    $a_word['example'] = '';
                } else {
                    $a_word['examples'] = $ex;
                }
                $ar_data[] = $a_word;
            }
            $json_word = json_encode($ar_data);
//        print_r($data2);
        }
        return '{"data":' . $json_word . '}';
    }

    //dang hoc
    public function getLearningList() {
        return view('learn.dang-hoc.danh-sach-tu');
    }

    //da hoc thuoc
    public function getLearned() {
        return view('learn.da-hoc');
    }


    //chua hoc
    public function getNotLearn() {
        return view('learn.chua-hoc');
    }

}
