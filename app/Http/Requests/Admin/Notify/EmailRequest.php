<?php

namespace App\Http\Requests\admin\notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            //store
            return [
                'subject' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'body' => 'required|max:10000|min:5|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'published_at' => 'required|numeric',
            ];
        } else {
            //update
            return [
                'subject' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'body' => 'required|max:10000|min:5|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء.,><\/;\n\r&؟?!" ]+$/u',
                'published_at' => 'required|numeric',
            ];
        }
    }
}
