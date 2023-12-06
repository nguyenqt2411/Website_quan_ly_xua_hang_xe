<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $validate = [
            'name'  => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.$this->id,
            'role'  => 'required',
            'phone'  => 'required|regex:/^0[0-9]{9}$/',
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
        $admin = Auth::user();
        if ($admin->hasRole(ADMINISTRATOR)) {
            $validate['shop_id'] = 'required';
        }
        if ($request->submit !== 'update') {
            $validate['password'] = 'required | max:191 ';
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập vào tên tài khoản',
            'email.unique' => 'Tên tài khoản không thể trùng lặp',
            'email.max' => 'Tên tài khoản vượt quá số ký tự cho phép',
            'password.required' => 'Vui lòng nhập mật khẩu đăng nhập',
            'role.required' => 'Vui lòng chọn vai trò của người dùng',
            'images.image'               => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes'               => 'Vui lòng nhập đúng định dạng file ảnh',
            'phone.required'     => 'Vui lòng nhập vào số điện thoại',
            'phone.regex'     => 'Không đúng định dạng dữ liệu',
            'shop_id.required'     => 'Vui lòng chọn cửa hàng',
        ];
    }
}
