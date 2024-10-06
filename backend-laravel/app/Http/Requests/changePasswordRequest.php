<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
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
            'old_password' => 'required', 
            'new_password' => 'required|min:6', 
            'new_password_c' => 'required|same:new_password', 
        ];
        
    }
    public function messages(): array
    {
        return [
            'old_password.required' => 'Mật khẩu hiện tại là bắt buộc!',
            'new_password.required' => 'Mật khẩu mới là bắt buộc!',
            'new_password.min' => 'Mật khẩu mới ít nhất 6 ký tự!',
            'new_password_c.required' => 'Nhập lại mật khẩu mới là bắt buộc!',
            'new_password_c.same' => 'Nhập lại mật khẩu không trùng khớp!',
        ];
    }
}
