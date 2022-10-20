<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255',Rule::unique('products','title')],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'type' => ['required'],
            'is_visible' => ['required','numeric'],
            'image' => ['required','mimes:jpg,jpeg,png','max:2048'],
            'category_id' => ['required']
        ];
    }
}
