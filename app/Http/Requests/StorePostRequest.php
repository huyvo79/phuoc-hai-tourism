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
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.string' => 'Tiêu đề phải là một chuỗi văn bản.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',

            'summary.max' => 'Tóm tắt ngắn không được vượt quá 500 ký tự.',

            'content.required' => 'Nội dung chi tiết không được để trống.',

            'category_id.required' => 'Vui lòng chọn danh mục cho bài viết.',
            'category_id.exists' => 'Danh mục bạn chọn không tồn tại trong hệ thống.',

            'thumbnail.image' => 'File tải lên phải là định dạng hình ảnh.',
            'thumbnail.mimes' => 'Ảnh bìa chỉ hỗ trợ các định dạng: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Dung lượng ảnh bìa không được vượt quá 2MB.',

            'priority.integer' => 'Độ ưu tiên phải là một số nguyên.',
            'priority.min' => 'Độ ưu tiên không được là số âm.',

            'latitude.numeric' => 'Vĩ độ phải là một con số.',
            'latitude.between' => 'Vĩ độ phải nằm trong khoảng từ -90 đến 90.',

            'longitude.numeric' => 'Kinh độ phải là một con số.',
            'longitude.between' => 'Kinh độ phải nằm trong khoảng từ -180 đến 180.',

            'related_ids.*.exists' => 'Một trong các bài viết liên quan không tồn tại.'
        ];
    }
}