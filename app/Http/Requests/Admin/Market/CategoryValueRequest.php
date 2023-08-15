<?php

namespace App\Http\Requests\admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'value' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            'price_increase' => 'required|numeric',
            'type' => 'required|numeric|in:0,1',
            'product_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:products,id',
        ];
    }
}
