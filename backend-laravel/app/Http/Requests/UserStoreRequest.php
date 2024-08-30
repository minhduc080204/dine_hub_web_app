<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            // 'user_name.required' => 'Tên không được để trống',
            // 'email.required' => 'Email không được để trống',
            // '422' => 'Email không đúng định dạng',
            '409' => 'Email đã tồn tại',
            // '400' => 'Mật khẩu không được để trống',
            // '422' => 'Mật khẩu không trùng khớp',
        ];
    }
}
