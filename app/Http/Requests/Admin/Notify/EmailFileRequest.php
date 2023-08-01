<?php

namespace App\Http\Requests\admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
                'file' => 'required|mimes:png,jpg,jpeg,gif,zip,pdf,docx,txt',
                'status' => 'required|numeric|in:0,1',
            ];
        } else {
            //update
            return [
                'file' => 'mimes:png,jpg,jpeg,gif,zip,pdf,docx,txt',
                'status' => 'required|numeric|in:0,1',
            ];
        }
    }
}
