<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
            'name' => 'required',
            'string',
            'max: 255',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên thẻ là bắt buộc!',
            'name.max' => 'Tên thẻ có độ dài tối đa 255!',
        ];
    }
}