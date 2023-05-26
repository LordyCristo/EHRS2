<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'payor_name' => ['required', 'string', 'max:255'],
            'payor_email' => ['nullable', 'string', 'email', 'max:255'],
            'payor_mobile' => ['nullable', 'string', 'max:255'],
            'client_id' => ['required', 'exists:clients,id'],
            'service_id' => ['required', 'exists:fees,id'],
            'collector_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'numeric'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'payor_name.required' => 'Required field',
            'payor_name.string' => 'Invalid input',
            'payor_name.max' => 'Too long',
            'payor_email.string' => 'Invalid input',
            'payor_email.email' => 'Invalid format',
            'payor_email.max' => 'Too long',
            'payor_mobile.string' => 'Invalid input',
            'payor_mobile.max' => 'Too long',
            'client_id.required' => 'Required field',
            'client_id.exists' => 'Client does not exist',
            'service_id.required' => 'Required field',
            'service_id.exists' => 'Service does not exist',
            'collector_id.required' => 'Required field',
            'collector_id.exists' => 'Collector does not exist',
            'amount.required' => 'Required field',
            'amount.numeric' => 'Invalid input',
            'remarks.string' => 'Invalid input',
            'remarks.max' => 'Too long',
        ];
    }
}
