<?php

namespace App\Http\Requests\admin\content;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
                'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'body' => 'required|max:10000|min:5|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            ];

        }else{
            //update
            return [
                'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'body' => 'required|max:10000|min:5|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            ];
        }
    }
}
