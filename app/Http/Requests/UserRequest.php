<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return TRUE;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
                    'name' => 'required|unique:users,name',
                    'password' => 'required',
                    'repassword' => 'required|same:password',
                    'email' => 'required|unique:users,email|regex:/^[a-z][a-z0-9]*(_[a-z0-9]+)*(\.[a-z0-9]+)*@[a-z0-9]([a-z0-9-][a-z0-9]+)*(\.[a-z]{2,4}){1,2}$/',
//                    'level' =>'required',
		];
	}
        
        public function messages() {
            return [
                'name.required' => 'Tên đăng nhập không được bỏ trống!',
                'name.unique' => 'Tên đăng nhập đã tồn tại!',
                'password.required' => 'Mật khẩu không được bỏ trống!',
                'repassword.required' => 'Vui lòng nhập lại mật khẩu!',
                'repassword.same' => 'Mật khẩu nhập lại không khớp!',
                'email.required' => 'Email không được bỏ trống!',
                'email.unique' => 'Email đã tồn tại!',
                'email.regex' => 'Email nhập vào không đúng!',
//                'level.required' => 'Bạn chưa chọn cấp độ cho người dùng!',
            ];
        }

}
