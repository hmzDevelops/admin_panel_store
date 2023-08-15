<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $route = Route::current();
        if ($route->getName() == 'admin.user.role.store') {
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'description' => 'required|max:200|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'permissions.*' => 'exists:permissions,id',
            ];
        } elseif ($route->getName() == 'admin.user.role.update') {
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
                'description' => 'required|max:200|min:2|regex:/^[ا-یa-zA-Z\ك-ي-ء ]+$/u',
            ];
        }elseif ($route->getName() == 'admin.user.role.permission.update') {
            return [
                'permissions.*' => 'exists:permissions,id',
            ];
        }
    }
}
