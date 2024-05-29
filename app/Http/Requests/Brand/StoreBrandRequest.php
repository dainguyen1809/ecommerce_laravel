<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'logo' => [
                'required',
                'image',
                'max:2048',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'is_featured' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
