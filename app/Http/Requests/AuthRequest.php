<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            
            'TenDangNhap' => ['required'],
            'MatKhau' => ['required'],
        ];
    }
    public function messages(): array
    {
        return [
            'TenDangNhap.required' => 'vui lòng nhập username',
            'MatKhau.required' => 'vui lòng nhập password'
        ];
    }
}
