<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route()->id;

        $rules = [
            "first_name"            => "required|string",
            "last_name"             => "required|string",
            "password"              => 'required|string|min:8',
            "password_confirmation" => 'required|string|min:8|same:password',
            "email"                 => "required|email|unique:users",
            "phone"                 => "required|string|max:12|min:10",
        ];

        if ($id) {
            $rules["email"] = 'email|unique:users,email,' . $id;
            $rules['password'] = 'string|min:8';
            $rules['password_confirmation'] = 'string|min:8|same:password';
        }

        return $rules;
    }
}
