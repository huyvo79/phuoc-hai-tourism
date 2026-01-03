<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền thực hiện request này hay không.
     * Đặt là 'true' để cho phép mọi người dùng (hoặc xử lý logic phân quyền ở đây).
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Các quy tắc xác thực (Validation Rules).
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users,username',
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * (Tùy chọn) Tùy chỉnh thông báo lỗi trả về.
     * Giúp trả về tiếng Việt thay vì tiếng Anh mặc định.
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique'   => 'Tên đăng nhập đã tồn tại.',
            'name.required'     => 'Vui lòng nhập họ tên.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }

    /**
     * (Quan trọng cho API) Xử lý khi validation thất bại.
     * Mặc định Laravel sẽ redirect (cho web), hàm này giúp trả về JSON đúng format bạn muốn.
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