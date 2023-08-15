<?php

namespace App\Http\Requests\admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'introduction' => 'required|max:1000|min:5',
                'weight' => 'required|max:1000|min:1|numeric',
                'length' => 'required|max:1000|min:1|numeric',
                'width' => 'required|max:1000|min:1|numeric',
                'height' => 'required|max:1000|min:1|numeric',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at' => 'required|numeric',
                'meta_key.*' => 'required',
                'meta_value.*' => 'required',

            ];

        }else{
            //update
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'introduction' => 'required|max:1000|min:5',
                'weight' => 'required|max:1000|min:1|numeric',
                'length' => 'required|max:1000|min:1|numeric',
                'width' => 'required|max:1000|min:1|numeric',
                'height' => 'required|max:1000|min:1|numeric',
                'price' => 'required|numeric',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at' => 'required|numeric',
            ];
        }
    }
}
