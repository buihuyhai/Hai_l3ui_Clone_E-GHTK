<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "first_name" => "required|string",
            "last_name"  => "required|string",
            "email"      => "required|email|unique:users",
            "phone"      => "required|string|max:12|min:10",
        ];

        if ($id) {
            $rules["email"] = 'email|unique:users,email,' . $id;
        }

        return $rules;
    }
}
