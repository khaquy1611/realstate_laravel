<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|min:6',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required',
            'passwordConfirm' => 'bail|required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '(*) Tên không được để trống!',
            'email.required' => '(*) Email không được để trống!',
            'email.email' => '(*) Email không đúng định dạng, ví dụ: email@gmail.com!',
            'email.unique' => '(*) Email đã được đăng ký!',
            'password.required' => '(*) Mật khẩu không được để trống!',
            'name.min' => '(*) Tên phải có tối thiểu 6 kí tự!',
            'passwordConfirm.required' => '(*) Xác nhận mật khẩu không được để trống!',
            'passwordConfirm.same' => '(*) Confirm password phải giống mật khẩu!',
        ];
    }
}