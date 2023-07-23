<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return auth()->check();
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
                'description' => 'required|max:120|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            ];

        }else{
            //update
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'description' => 'required|max:120|min:5',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            ];
        }

    }

    //تعریف خطای فارسی هر متغیر
    public function attributes()
    {
        return [
            'name' => 'نام دسته بندی',
        ];
    }
}
