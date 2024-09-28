<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'expires_at' => 'nullable|after_or_equal:today',
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Mã giảm giá là bắt buộc!',
            'code.unique' => 'Mã giảm giá này đã tồn tại!',
            'discount.required' => 'Giảm giá là bắt buộc!',
            'discount.numeric' => 'Giảm giá phải là số!',
            'discount.min' => 'Giảm giá không được nhỏ hơn 1%!',
            'discount.max' => 'Giảm giá không được lớn hơn 100%!',
            'expires_at.after_or_equal' => 'Ngày hết hạn không được sớm hơn ngày hôm nay!',
        ];
    }
}