<?php

namespace App\Http\Requests\admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء-آ., ]+$/u',
            'percentage' => 'required|max:100|min:1|numeric',
            'discount_ceiling' => 'required|max:1000000000000|min:1|numeric',
            'minimal_order_amount' => 'required|max:1000000000000|min:1|numeric',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ];
    }
}
