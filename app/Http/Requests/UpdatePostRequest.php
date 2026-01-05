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
            'title' => 'sometimes|required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'summary' => 'nullable|string',
            'content' => 'sometimes|required|string',
            'thumbnail' => 'nullable|image|max:2048', 
            'priority' => 'integer|min:0',

            // Validate Tọa độ (cho phép sửa đổi)
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            // Validate Bài viết liên quan (cho phép sửa đổi)
            'related_ids' => 'nullable|array',
            'related_ids.*' => 'exists:posts,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề bài viết không được để trống.',
            'title.max' => 'Tiêu đề quá dài, vui lòng nhập dưới 255 ký tự.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',

            'category_id.exists' => 'Danh mục đã chọn không tồn tại trong hệ thống.',

            'content.required' => 'Nội dung chi tiết không được để trống.',
            'content.string' => 'Nội dung phải là dạng văn bản.',

            'thumbnail.image' => 'File tải lên bắt buộc phải là hình ảnh (jpg, jpeg, png...).',
            'thumbnail.max' => 'Dung lượng ảnh quá lớn. Vui lòng chọn ảnh dưới 2MB.',

            'priority.integer' => 'Độ ưu tiên phải là một số nguyên.',
            'priority.min' => 'Độ ưu tiên không được nhỏ hơn 0.',

            // Thông báo lỗi cho Tọa độ
            'latitude.numeric' => 'Vĩ độ phải là một số.',
            'latitude.between' => 'Vĩ độ phải nằm trong khoảng từ -90 đến 90.',
            'longitude.numeric' => 'Kinh độ phải là một số.',
            'longitude.between' => 'Kinh độ phải nằm trong khoảng từ -180 đến 180.',

            // Thông báo lỗi cho Bài liên quan
            'related_ids.array' => 'Dữ liệu bài viết liên quan không hợp lệ.',
            'related_ids.*.exists' => 'Một trong các bài viết liên quan đã chọn không tồn tại.',
        ];
    }
}