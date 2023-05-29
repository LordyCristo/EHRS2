<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'client_type' => ['required', 'integer', 'exists:client_types,id'],
            'amount' => ['required', 'numeric'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'service_id.required' => 'Required field',
            'service_id.integer' => 'Invalid value',
            'service_id.exists' => 'ID does not exist',
            'client_type.required' => 'Required field',
            'client_type.integer' => 'Invalid value',
            'client_type.exists' => 'Client type does not exist',
            'amount.required' => 'Required field',
            'amount.numeric' => 'Invalid value',
        ];
    }
}
