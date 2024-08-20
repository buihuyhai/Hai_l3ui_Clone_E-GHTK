<?php

namespace Modules\Promotion\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:coupons,code',
            'value' => 'required|numeric|min:0',
            'percent' => 'required|numeric|min:0|max:100',
            'from' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:1',
            'used' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'expired_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
