<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function stripUnicode($str) {
    if (!$str) {
        return FALSE;
    }
    $unicode = [
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ',
        'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    ];
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode('|', $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    return $str;
}

function changeTitle($str) {
    $str = trim($str);
    if ($str == "") {
        return "";
    }
    $str = str_replace('"', '', $str);
    $str = str_replace('\'', '', $str);
    $str = stripUnicode($str);
    $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
    // MB_CASE_UPPER | MB_CASE_TITLE | MB_CASE_LOWER
    $str = str_replace(' ', '-', $str);
    return $str;
}

function ex_to_word($ex_id, $ex) {
//    $ar_word = explode(' ', $ex);
//    foreach ($ar_word as $value) {
//        $word = DB::table('words')->where('word', trim($value, '.,!?;:'))->first();
//        if (!empty($word)) {
//            $w_ex = DB::table('word_exes')->where('word_id', $word->id)
//                            ->where('example_id', $ex_id)->first();
//            if (empty($w_ex)) {
//                DB::table('word_exes')->insert(
//                        ['word_id' => $word->id, 'example_id' => $ex_id]
//                );
//            }
//        }
//    }

    $arr_seach = [',', '.', ':', ';', '?', '!', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', '=', '+'];
    $example = str_replace($arr_seach, '', mb_convert_case($ex, MB_CASE_LOWER, 'utf-8'));

    $ar_word = DB::table('words')->get();
    foreach ($ar_word as $word) {
        if (strpos($example, ' ' . $word->word . ' ')) {
            $w_ex = DB::table('word_exes')->where('word_id', $word->id)
                            ->where('example_id', $ex_id)->first();
            if (empty($w_ex)) {
                DB::table('word_exes')->insert(
                        ['word_id' => $word->id, 'example_id' => $ex_id]
                );
            }
        }
    }
}

function word_to_ex($w_id, $word) {
    $ar_ex = DB::table('examples')->get();
    $arr_seach = [',', '.', ':', ';', '?', '!', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', '=', '+'];
    foreach ($ar_ex as $ex) {
//        $ar_word = explode(' ', $ex->example);
//        foreach ($ar_word as $val) {
//            $word1 = mb_convert_case($word, MB_CASE_LOWER, 'utf-8');
//            $word2 = mb_convert_case(trim($val, '.,!?;:'), MB_CASE_LOWER, 'utf-8');
//            if (strcmp($word1, $word2) == 0) {
//                $w_ex = DB::table('word_exes')->where('word_id', $w_id)
//                                ->where('example_id', $ex->id)->first();
//                if (empty($w_ex)) {
//                    DB::table('word_exes')->insert(
//                            ['word_id' => $w_id, 'example_id' => $ex->id]
//                    );
//                }
//            }
//        }
//        strpos($haystack, $ex);
        $example = str_replace($arr_seach, '', mb_convert_case($ex->example, MB_CASE_LOWER, 'utf-8'));

        if (strpos($example, ' ' . $word . ' ')) {
            $w_ex = DB::table('word_exes')->where('word_id', $w_id)
                            ->where('example_id', $ex->id)->first();
            if (empty($w_ex)) {
                DB::table('word_exes')->insert(
                        ['word_id' => $w_id, 'example_id' => $ex->id]
                );
            }
        }
    }
}

function del_word_ex($word_id) {
    $wordExList = App\WordEx::where('word_id', $word_id)->get();
    foreach ($wordExList as $wordEx) {
        $wordEx->delete();
    }
}

function del_ex_word($ex_id) {
    $exampleExList = App\WordEx::where('example_id', $ex_id)->get();
    foreach ($exampleExList as $exampleEx) {
        $exampleEx->delete();
    }
}
