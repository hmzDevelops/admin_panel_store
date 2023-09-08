<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                'orginal_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'persian_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'logo' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',

            ];

        }else{
            //update
            return [
                'orginal_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'persian_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'logo' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            ];
        }
    }
}
