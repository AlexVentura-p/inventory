<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class PatchProductRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'unit_price' => ['nullable', 'numeric', 'min:0.01'],
            'type' => ['nullable'],
            'is_visible' => ['nullable', 'numeric'],
            'image' => ['nullable','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
}
