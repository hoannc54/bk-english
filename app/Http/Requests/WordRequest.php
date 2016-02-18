<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'word'  =>  'required|unique:words,word',
            'spell'  =>  'required',
            'means'  =>  'required'
        ];
    }
    public function messages() {
        return [
            'word.required' =>  'Vui lòng nhập từ!',
            'word.unique'  =>  'Từ đã tồn tại!',
            'spell.required' =>  'Bạn chưa nhập phát âm!',
            'means.required' =>  'Bạn chưa nhập nghĩa!'
        ];
    }
}
