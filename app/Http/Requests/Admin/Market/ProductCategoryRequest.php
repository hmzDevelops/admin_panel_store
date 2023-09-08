<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        if($this->isMethod('post')){
            //store
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'description' => 'required|max:400|min:5',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'parent_id' => 'nullable|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',

            ];

        }else{
            //update
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'description' => 'required|max:400|min:5',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'parent_id' => 'nullable|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
            ];
        }
    }
}
