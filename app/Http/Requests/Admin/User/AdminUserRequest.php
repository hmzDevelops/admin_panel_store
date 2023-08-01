<?php

namespace App\Http\Requests\admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUserRequest extends FormRequest
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
                'firstname' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'lastname' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'mobile' => 'required|digits:11|unique:users',
                'email' => 'required|string|unique:users|email',
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
            ];
        } else {
            //update
            return [
                'firstname' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'lastname' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }
}
