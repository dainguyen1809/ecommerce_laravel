<?php

namespace App\Http\Requests\VendorShopProfile;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorShopProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'banner' => [
                'nullable',
                'image',
                'max:2048',
            ],
            'shop_name' => [
                'required',
                'max:255',
            ],
            'phone' => [
                'required',
                'numeric',
                'digits_between:0,20',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'address' => [
                'required',
                'max:255',
            ],
            'description' => [
                'required',
                'max:1000',
            ],
            'fb_link' => [
                'nullable',
                'url',
            ],
            'ins_link' => [
                'nullable',
                'url',
            ],
        ];
    }
}
