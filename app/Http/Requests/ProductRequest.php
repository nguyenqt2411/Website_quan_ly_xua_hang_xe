<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'trademark_id'  => 'required',
            'category_id'  => 'required',
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
        $admin = Auth::user();
        if ($admin->hasRole(ADMINISTRATOR)) {
            $validate['shop_id'] = 'required';
        }
        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'Dữ liệu không thể để trống',
            'trademark_id.required' => 'Dữ liệu không thể để trống',
            'category_id.required' => 'Dữ liệu không thể để trống',
            'shop_id.required' => 'Dữ liệu không thể để trống',
            'images.image'               => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes'               => 'Vui lòng nhập đúng định dạng file ảnh',
        ];
    }
}
