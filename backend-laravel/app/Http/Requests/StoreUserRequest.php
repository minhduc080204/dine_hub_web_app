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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max: 150',
            'email' => 'required|string|email',
            'phone_number' => 'required|numeric|regex:/^[0-9]{10,11}$/',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc!',
            'name.max' => 'Tên người dùng không được quá 150 ký tự!',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng',
            'phone_number.required' => 'Số điện thoại là bắt buộc!',
            'phone_number.regex' => 'Số điện thoại phải 10 hoặc 11 số!',
            'phone_number.numeric' => 'Số điện thoại phải là số!',
        ];
    }
}