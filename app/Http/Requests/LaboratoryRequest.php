<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaboratoryRequest extends FormRequest
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
            'infirmary_id' => ['required', 'exists:clients,infirmary_id'],
            'physician' => ['required', 'exists:users,id'],
            'urinalysis' => ['nullable', 'boolean'],
            'stool_exam' => ['nullable', 'boolean'],
            'cbc' => ['nullable', 'boolean'],
            'platelet_count' => ['nullable', 'boolean'],
            'bleeding_clottting_time' => ['nullable', 'boolean'],
            'hemoglobin' => ['nullable', 'boolean'],
            'hematocrit' => ['nullable', 'boolean'],
            'wbc_diff_count' => ['nullable', 'boolean'],
            'blood_typing' => ['nullable', 'boolean'],
            'pregnancy_test' => ['nullable', 'boolean'],
            'afb_straining' => ['nullable', 'boolean'],
            'is_other' => ['nullable', 'boolean'],
            'other_value' => ['nullable', 'string'],
            'ward' => ['required', 'string'],
            'status' => ['required', 'in:pending,done,released'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Invalid infirmary id',
            'physician.required' => 'Required field',
            'physician.exists' => 'Invalid physician id',
            'urinalysis.boolean' => 'Invalid value',
            'stool_exam.boolean' => 'Invalid value',
            'cbc.boolean' => 'Invalid value',
            'platelet_count.boolean' => 'Invalid value',
            'bleeding_clottting_time.boolean' => 'Invalid value',
            'hemoglobin.boolean' => 'Invalid value',
            'hematocrit.boolean' => 'Invalid value',
            'wbc_diff_count.boolean' => 'Invalid value',
            'blood_typing.boolean' => 'Invalid value',
            'pregnancy_test.boolean' => 'Invalid value',
            'afb_straining.boolean' => 'Invalid value',
            'is_other.boolean' => 'Invalid value',
            'ward.required' => 'Required field',
            'status.required' => 'Required field',
            'status.in' => 'Invalid value',
        ];
    }
}
