<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'calories' => 'required|integer',
            'category' => 'required',
            // 'image1' => 'required|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc!',
            'description.required' => 'mô tả là bắt buộc!',
            'price.required' => 'Giá sản phẩm là bắt buộc!',
            'weight.required' => 'Khối lượng sản phẩm là bắt buộc!',
            'calories.required' => 'Năng lượng sản phẩm là bắt buộc!',
            'category.required' => 'Danh mục sản phẩm là bắt buộc!',
            // 'image1.required' => 'Hình ảnh sản phẩm là bắt buộc!',
            'name.max' => 'Tên sản phẩm có tối đa 255 ký tự!',
            'price.numeric' => 'Giá sản phẩm phải nhập số!',
            'weight.numeric' => 'Khối lượng sản phẩm phải nhập số!',
            'calories.integer' => 'Năng lượng sản phẩm phải là số nguyên!',
            // 'image1.image' => 'File không phải là hình ảnh!',
            // 'image.max' => 'Hình ảnh có kích thước tối đa 5MB !',
        ];
    }
}