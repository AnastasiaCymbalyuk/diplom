<?php

namespace App\Http\Requests\Hall;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'name' => 'string|min:1|max:10',
            'row' => 'nullable|integer|max:15',
            'place' => 'nullable|integer|max:15',
            'price' => 'nullable|integer',
            'vipPrice' => 'nullable|integer',
        ];
    }
}
