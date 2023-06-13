<?php

namespace App\Http\Requests;

use App\Rules\UniqueServicePerTransaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $id = $this->route('id');
        return [
            'or_no' => ['required', 'numeric', Rule::unique('payments','or_no')->ignore($id)], // 'nullable' means 'optional
            'payor_name' => ['required', 'string', 'max:255'],
            'payor_email' => ['nullable', 'string', 'email', 'max:255'],
            'payor_mobile' => ['nullable', 'string', 'max:255'],
            'infirmary_id' => ['required', 'exists:clients,infirmary_id'],
            // rows must have at least one row and must be an array and the row must have a value service_id and fee
            'rows' => ['required', 'array', 'min:1'],
            'rows.*.service_id' => ['required', 'exists:fees,id', new UniqueServicePerTransaction($id)],
            'rows.*.fee' => ['required', 'numeric'],
            'collector_id' => ['required', 'exists:users,id'],
            'total_amount' => ['required', 'numeric'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'or_no.required' => 'Required field',
            'or_no.numeric' => 'Invalid input',
            'or_no.unique' => 'OR number already exists',
            'payor_name.required' => 'Required field',
            'payor_name.string' => 'Invalid input',
            'payor_name.max' => 'Too long',
            'payor_email.string' => 'Invalid input',
            'payor_email.email' => 'Invalid format',
            'payor_email.max' => 'Too long',
            'payor_mobile.string' => 'Invalid input',
            'payor_mobile.max' => 'Too long',
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Client does not exist',
            'collector_id.required' => 'Required field',
            'collector_id.exists' => 'Collector does not exist',
            'rows.required' => 'Required field',
            'rows.array' => 'Invalid input',
            'rows.*.service_id.required' => 'Required field',
            'rows.*.service_id.exists' => 'Service does not exist',
            'rows.*.fee.required' => 'Required field',
            'rows.*.fee.numeric' => 'Invalid input',
            'rows.min' => 'At least one row is required',
            'total_amount.required' => 'Required field',
            'total_amount.numeric' => 'Invalid input',
            'remarks.string' => 'Invalid input',
            'remarks.max' => 'Too long',
        ];
    }
}
