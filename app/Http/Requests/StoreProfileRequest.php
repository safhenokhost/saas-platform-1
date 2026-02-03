<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'full_name'   => ['required', 'string', 'min:3'],
        'postal_code' => ['required', 'regex:/^\d{10}$/'], // 10 رقم دقیق
        'mobile'      => ['required', 'regex:/^09\d{9}$/'], // 09xxxxxxxxx
        'address'     => ['nullable', 'string', 'min:5'],
        'avatar'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'lat'         => ['nullable', 'numeric'],
        'lng'         => ['nullable', 'numeric'],
    ];
}

public function messages()
{
    return [
        'postal_code.regex' => 'کد پستی باید دقیقاً ۱۰ رقم باشد',
        'mobile.regex'      => 'شماره موبایل معتبر نیست (مثال: 09123456789)',
        'avatar.image'      => 'فایل باید تصویر باشد',
        'avatar.max'        => 'حداکثر حجم تصویر ۲ مگابایت است',
    ];
}

}
