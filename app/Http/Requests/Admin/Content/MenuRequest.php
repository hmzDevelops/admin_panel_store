<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'url' => 'required|max:10000|min:5|regex:/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]].[a-zA-Z]{2,}$/u',
                'status' => 'required|numeric|in:0,1',
                'parent_id' => 'nullable|min:1|regex:/^[0-9]+$/u|exists:menus,id',
            ];

        }else{
            //update
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'url' => 'required|max:10000|min:5|regex:/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]].[a-zA-Z]{2,}$/u',
                'status' => 'required|numeric|in:0,1',
                'parent_id' => 'nullable|min:1|regex:/^[0-9]+$/u|exists:menus,id',
            ];
        }
    }
}
