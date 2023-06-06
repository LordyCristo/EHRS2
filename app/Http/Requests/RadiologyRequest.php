<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RadiologyRequest extends FormRequest
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
            'or_no' => ['required', 'integer', 'exists:payments_services,payment_id', Rule::unique('xray_requests')->ignore($id)],
            'rqst_for' => ['required', 'string'],
            'history' => ['nullable', 'string'],
            'rqst_physician' => ['required', 'integer', 'exists:users,id'],
            'ward' => ['required', 'string'],
            'status' => ['required', 'string', 'in:pending,released'],

            'rqst_id' => ['required', 'integer', 'exists:xray_requests,id', Rule::unique('xrays')->ignore($id)],
            'procedure' => ['required', 'string'],
            'impression' => ['required', 'string'],
            'radiographic_findings' => ['nullable', 'string'],
            'rad_tech_id' => ['required', 'integer', 'exists:users,id'],
            'radiologist_id' => ['required', 'integer', 'exists:users,id'],
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
            'required' => 'Field is required.',
            'integer' => 'Field must be an integer.',
            'exists' => 'ID does not exist.',
            'string' => 'Field must be a string.',
            'in' => 'Invalid field value.',
        ];
    }
}
