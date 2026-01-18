<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'priority' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'related_ids' => 'nullable|array',
            'related_ids.*' => 'exists:posts,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề bài viết không được để trống.',
            'title.string' => 'Tiêu đề bài viết phải là dạng chuỗi.',
            'title.max' => 'Tiêu đề bài viết không được vượt quá 255 ký tự.',
            
            'summary.max' => 'Tóm tắt bài viết không được vượt quá 500 ký tự.',
            
            'content.required' => 'Nội dung bài viết không được để trống.',
            
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục đã chọn không tồn tại.',
            
            'thumbnail.image' => 'Tệp tải lên phải là hình ảnh.',
            'thumbnail.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Dung lượng ảnh bìa không được lớn hơn 2MB.',
            
            'priority.integer' => 'Độ ưu tiên phải là số nguyên.',
            'priority.min' => 'Độ ưu tiên phải lớn hơn hoặc bằng 0.',
            
            'latitude.numeric' => 'Vĩ độ phải là giá trị số.',
            'latitude.between' => 'Vĩ độ phải nằm trong khoảng -90 đến 90.',
            
            'longitude.numeric' => 'Kinh độ phải là giá trị số.',
            'longitude.between' => 'Kinh độ phải nằm trong khoảng -180 đến 180.',
            
            'related_ids.*.exists' => 'Bài viết liên quan đã chọn không hợp lệ.'
        ];
    }
}