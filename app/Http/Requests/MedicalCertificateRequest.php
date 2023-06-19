<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MedicalCertificateRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cbc' => ['nullable', 'boolean'],
            'urinalysis' => ['nullable', 'boolean'],
            'fecalysis' => ['nullable', 'boolean'],
            'drug_test' => ['nullable', 'boolean'],
            'chest_xray' => ['nullable', 'boolean'],
            'psychological' => ['nullable', 'boolean'],
            'neuropsychiatric' => ['nullable', 'boolean'],
            'nolabneeded' => ['nullable', 'boolean'],
            'is_fit' => ['required', 'boolean'],
            'purpose' => ['required', 'numeric'],
            'purpose_sport' => ['nullable', 'string'],
            'specific_purpose' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'physician_id' => ['required', 'exists:users,id'],
            'infirmary_id' => ['required', 'exists:clients,infirmary_id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'cbc.boolean' => 'Invalid value',
            'urinalysis.boolean' => 'Invalid value',
            'fecalysis.boolean' => 'Invalid value',
            'drug_test.boolean' => 'Invalid value',
            'chest_xray.boolean' => 'Invalid value',
            'psychological.boolean' => 'Invalid value',
            'neuropsychiatric.boolean' => 'Invalid value',
            'nolabneeded.boolean' => 'Invalid value',
            'is_fit.required' => 'Invalid value',
            'is_fit.boolean' => 'Invalid value',
            'purpose.required' => 'Invalid value',
            'purpose.string' => 'Invalid value',
            'purpose_sport.string' => 'Invalid value',
            'specific_purpose.string' => 'Invalid value',
            'remarks.string' => 'Invalid value',
            'physician_id.required' => 'Required field',
            'physician_id.exists' => 'Physician does not exist',
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Patient does not exist',
        ];
    }
}
