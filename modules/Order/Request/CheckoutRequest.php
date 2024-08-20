<?php

namespace Modules\Order\Request;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Modules\Shop\Enum\StatusShopEnum;

class CheckoutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'email',
                'string',
                'max:255',
            ],
            'address' => [
                'string',
                'string',
                'max:500',
            ],
            'phone_number' => [
                'string',
                'regex:/^[0-9]{10}$/',
                'max:12'
            ],
            'description' => 'nullable|string',
            'coupons' => [
                'required',
                'json',
            ],
            'detail' => [
                'required',
                'json',
            ],
            'carts' => [
                'required',
                'array',
            ]
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator)
    {
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors()->first(), 422));
    }
}
