<?php

namespace App\Http\Requests;

use App\Rules\UniqueServiceClientType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $id = $this->route('id');
        return [
            'service_id' => ['required', 'exists:services,id', new UniqueServiceClientType($id)],
            'client_type' => ['required', 'exists:client_types,id', new UniqueServiceClientType($id)],
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
