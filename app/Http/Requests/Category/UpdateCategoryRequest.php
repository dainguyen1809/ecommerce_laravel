<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'icon' => [
                'required',
                'not_in:empty',
            ],
            'name' => [
                'required',
                'max:255',
                Rule::unique(Category::class)->ignore($this->route('category')),

            ],
            'status' => [
                'required',
            ],
        ];
    }
}
