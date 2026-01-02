<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Luật cho trang Thêm mới (thường bắt buộc nhiều hơn Update)
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048', 
            'priority' => 'integer|min:0',
        ];
    }

    // COPY HÀM NÀY VÀO FILE StorePostRequest.php
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề bài viết không được để trống.',
            'title.max' => 'Tiêu đề quá dài, vui lòng nhập dưới 255 ký tự.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',

            'category_id.required' => 'Vui lòng chọn một danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',

            'content.required' => 'Nội dung chi tiết không được để trống.',
            'content.string' => 'Nội dung phải là văn bản.',

            'thumbnail.image' => 'File tải lên phải là hình ảnh.',
            'thumbnail.max' => 'Ảnh quá lớn, vui lòng chọn ảnh dưới 2MB.',

            'priority.integer' => 'Độ ưu tiên phải là số nguyên.',
            'priority.min' => 'Độ ưu tiên không được nhỏ hơn 0.',
        ];
    }
}