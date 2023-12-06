<?php

namespace App\Http\Requests\Ticket;

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
            'place_id' => 'integer',
            'session_id' => 'integer',
            'type' => 'string|min:2|max:25',
            'date' => 'string',
            'price' => 'integer',
            'row' => 'integer|max:15',
            'place' => 'integer|max:15',
            'qr' => 'string',
        ];
    }
}
