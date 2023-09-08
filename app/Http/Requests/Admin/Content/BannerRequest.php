<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,آ ]+$/u',
                'url' => [
                    'required' ,
                    'max:10000',
                    'min:5',
                    'regex:/^(http|https)\:\/\/[a-zA-Z0-9]{1,61}\.[a-zA-Z]{2,}$/u'
                ],
                'status' => 'required|numeric|in:0,1',
                'position' => 'required|numeric',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            ];

        }else{
            //update
            return [
                'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'url' => [
                    'required' ,
                    'max:10000',
                    'min:5',
                    'regex:/^(http|https)\:\/\/[a-zA-Z0-9]{1,61}\.[a-zA-Z]{2,}$/u'
                ],

                'status' => 'required|numeric|in:0,1',
                'position' => 'required|numeric',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }
}
