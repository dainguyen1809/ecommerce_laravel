<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'type' => [
                'string',
                'max:255',
            ],
            'title' => [
                'required',
                'max:255',
            ],
            'starting_price' => [
                'numeric',
            ],
            'btn_url' => [
                'url',
            ],
            'serial' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
