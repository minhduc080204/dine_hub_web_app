<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }
    public function messages(): array
    {
        return [
            'image.required' => 'Hình ảnh danh mục là bắt buộc!',
            'image.image' => 'File không phải là hình ảnh!',
            'image.mimes' => 'Hình ảnh không hợp lệ (phải có đuôi jpeg,png,jpg,gif)!',
            'image.max' => 'Hình ảnh có kích thước tối đa 5MB !',
        ];
    }
}
