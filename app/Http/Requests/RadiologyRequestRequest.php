<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RadiologyRequestRequest extends FormRequest
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
            'infirmary_id' => ['required', 'integer', 'exists:clients,infirmary_id'],
            'or_no' => ['nullable', 'integer', 'exists:payments_service,payment_id', Rule::unique('xray_requests')->ignore($id)],
            'rqst_for' => ['required', 'string'],
            'history' => ['nullable', 'string'],
            'rqst_physician' => ['required', 'integer', 'exists:users,id'],
            'ward' => ['required', 'string'],
            'status' => ['required', 'string', 'in:pending,released'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'infirmary_id.required' => 'Required field',
            'infirmary_id.integer' => 'Invalid value',
            'infirmary_id.exists' => 'Do not exist value',
            'or_no.required' => 'Required field',
            'or_no.integer' => 'Invalid value',
            'or_no.exists' => 'Do not exist value',
            'or_no.unique' => 'Already taken',
            'rqst_for.required' => 'Required field',
            'rqst_for.string' => 'Invalid value',
            'history.string' => 'Invalid value',
            'rqst_physician.required' => 'Required field',
            'rqst_physician.integer' => 'Invalid value',
            'rqst_physician.exists' => 'Do not exist value',
            'ward.required' => 'Required field',
            'ward.string' => 'Invalid value',
            'status.required' => 'Required field',
            'status.string' => 'Invalid value',
            'status.in' => 'Invalid value',
        ];
    }
}
