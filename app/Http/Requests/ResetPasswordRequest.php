<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'password' => 'bail|required',
            'passwordConfirm' => 'bail|required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => '(*) Mật khẩu không được để trống!',
            'passwordConfirm.required' => '(*) Xác nhận mật khẩu không được để trống!',
            'passwordConfirm.same' => '(*) Confirm password phải giống mật khẩu!',
        ];
    }
}