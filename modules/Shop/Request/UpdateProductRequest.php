<?php

namespace Modules\Shop\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Modules\Shop\Enum\StatusShopEnum;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ] ,
            'price' => [
                'required',
                'integer',
                'max:100000000',
                'min:1',
            ] ,
            'sale_price' => [
                'required',
                'integer',
                'max:100000000',
                'min:1',
            ] ,
            'slug' => [
                'required',
                'string',
                'max:255',
            ] ,
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id'),
            ],
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|file|max:2048|image',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator) {
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors()->first(), 422));
    }
}
