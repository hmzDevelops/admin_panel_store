<?php

namespace App\Http\Requests\admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'reciver' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,آ ]+$/u',
                'deliver' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,آ ]+$/u',
                'description' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,آ ]+$/u',
                'marketable_number' => 'required|numeric',
            ];

        }else{
            //update
            return [
                'marketable_number' => 'required|numeric',
                'frozen_number' => 'required|numeric',
                'sold_number' => 'required|numeric',
            ];
        }
    }
}
