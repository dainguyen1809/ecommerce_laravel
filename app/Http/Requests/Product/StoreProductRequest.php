<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            // 'sub_category' => ['nullable'],
            // 'child_category' => ['nullable'],
            'brand' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'video_link' => ['required', 'url'],
            'sku' => ['required', 'max:100'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
            'product_type' => ['required'],
        ];
    }
}
