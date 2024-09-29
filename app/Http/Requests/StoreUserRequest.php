<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $userId = $this->route('user'); // Hoặc cách lấy ID của người dùng hiện tại nếu có

        return [
            'name' => 'required|string|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => 'sometimes|required|string|min:6',
            'phone' => [
                'required',
                'numeric',
                'digits_between:8,10',
                Rule::unique('users')->ignore($userId),
            ],
            'image' => 'sometimes|required|image',
            'store_id' => 'required|exists:stores,id',
            'role' => 'required|in:manager,staff,cashier',
            'biography' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'name.min' => 'Họ và tên phải có độ dài lớn hơn 2 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.regex' => 'Email phải đúng định dạng: ví dụ example@mail.com.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Password không được để trống.',
            'password.min' => 'Password phải có ít nhất 6 ký tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại phải là một số.',
            'phone.digits_between' => 'Số điện thoại phải có độ dài từ 8 đến 10 ký tự.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'image.required' => 'Ảnh đại diện không được để trống.',
            'image.image' => 'Tệp tải lên phải là một hình ảnh.',
            'store_id.required' => 'Cửa hàng không được để trống.',
            'role.required' => 'Vai trò không được để trống.',
            'biography.required' => 'Tiểu sử không được để trống.',
            'biography.string' => 'Tiểu sử phải là một chuỗi văn bản.',
        ];
    }
}
