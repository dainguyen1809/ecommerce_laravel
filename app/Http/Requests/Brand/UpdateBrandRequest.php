<?php

namespace App\Http\Requests\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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
                'nullable',
                'image',
                'max:2048',
            ],
            'name' => [
                'required',
                'max:255',
                Rule::unique(Brand::class)->ignore($this->route('brand')),
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
