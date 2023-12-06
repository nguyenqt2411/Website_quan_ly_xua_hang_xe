<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
    public function rules()
    {
        return [
            //
            'name' => 'required|max:191|unique:shops,name,'.$this->id,
            'email' => 'required|email|max:191|unique:shops,email,'.$this->id,
            'phone'  => 'required|regex:/^0[0-9]{9}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Dữ liệu không thể để trống',
            'name.unique' => 'Dữ liệu đã bị trùng',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'email.required' => 'Vui lòng nhập vào tên tài khoản',
            'email.unique' => 'Tên tài khoản không thể trùng lặp',
            'email.max' => 'Tên tài khoản vượt quá số ký tự cho phép',
            'email.email' => 'Định dạng email không chính xác',
            'phone.required'     => 'Vui lòng nhập vào số điện thoại',
            'phone.regex'     => 'Không đúng định dạng dữ liệu',
        ];
    }
}
