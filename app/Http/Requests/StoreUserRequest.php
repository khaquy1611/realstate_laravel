<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '(*) Tên không được để trống!',
            'username.required' => '(*) Họ tên không được để trống!',
            'email.required' => '(*) Email không được để trống!',
            'address.required' => '(*) Địa chỉ không được để trống!',
            'phone.required' => '(*) Số điện thoại không được để trống!',
            'role.required' => '(*) Vai trò không được để trống!',
            'status.required' => '(*) Trạng thái không được để trống!',
        ];
    }
}