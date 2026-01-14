<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    /**
     * Xác định quyền hạn. Đặt true để cho phép thực hiện.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các quy tắc xác thực.
     */
    public function rules(): array
    {
        return [
            'username' => [
                'sometimes', // Chỉ validate nếu client có gửi trường này lên
                'string',
                // Bỏ qua check trùng với chính user đang được cập nhật
                // Lưu ý: 'user' ở đây phải khớp với tên tham số trong Route (ví dụ: users/{user})
                Rule::unique('users')->ignore($this->route('user')), 
            ],
            'name' => [
                'sometimes', 
                'string', 
                'max:255'
            ],
            'password' => [
                'sometimes', 
                'string', 
                'min:6'
            ],
        ];
    }

    /**
     * (Tùy chọn) Tùy chỉnh thông báo lỗi tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'password.min'    => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }

    /**
     * Xử lý khi validation thất bại -> Trả về JSON thay vì redirect.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => 'Lỗi kiểm tra dữ liệu',
            'errors'  => $validator->errors()
        ], 422));
    }
}