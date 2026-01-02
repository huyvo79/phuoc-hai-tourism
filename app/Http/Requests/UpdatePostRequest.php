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
            'category_id' => 'sometimes|exists:categories,id',
            'summary' => 'nullable|string',
            'content' => 'sometimes|required|string',
            'thumbnail' => 'nullable|image|max:2048', 
            'priority' => 'integer|min:0',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi tiếng Việt
     */
    public function messages(): array
    {
        return [
            // Lỗi cho Title
            'title.required' => 'Tiêu đề bài viết không được để trống.',
            'title.max' => 'Tiêu đề quá dài, vui lòng nhập dưới 255 ký tự.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',

            // Lỗi cho Category
            'category_id.exists' => 'Danh mục đã chọn không tồn tại trong hệ thống.',

            // Lỗi cho Content
            'content.required' => 'Nội dung chi tiết không được để trống.',
            'content.string' => 'Nội dung phải là dạng văn bản.',

            // Lỗi cho Thumbnail (Ảnh)
            'thumbnail.image' => 'File tải lên bắt buộc phải là hình ảnh (jpg, jpeg, png...).',
            'thumbnail.max' => 'Dung lượng ảnh quá lớn. Vui lòng chọn ảnh dưới 2MB.',

            // Lỗi cho Priority (Độ ưu tiên)
            'priority.integer' => 'Độ ưu tiên phải là một số nguyên.',
            'priority.min' => 'Độ ưu tiên không được nhỏ hơn 0.',
        ];
    }
}