<?php

namespace Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'keyword' => 'nullable|string|max:255',
            'orderby' => 'nullable|in:price-asc,price-desc,rating,selling,latest', 
            'minPrice' => 'nullable|numeric|min:0', 
            'maxPrice' => 'nullable|numeric|min:0'
        ];
    }
}
