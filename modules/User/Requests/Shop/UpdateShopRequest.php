<?php

namespace Modules\User\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShopRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name'         => ['required', 'string', 'max:255',],
            'description'  => 'nullable|string',
            'address'      => 'required|string',
            'phone_number' => 'required|string|max:13',
            'email'        => ['required', 'string', 'email', Rule::unique('shops')->ignore($id, 'id'),],
            'status'       => "required",
            'logo_url'     => 'nullable|file|max:2048|image',
        ];
    }
}
