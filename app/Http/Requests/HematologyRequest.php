<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HematologyRequest extends FormRequest
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
            //hematology record
            'infirmary_id' => ['required', 'exists:clients,infirmary_id'],
            'rqst_physician' => ['required', 'exists:users,id'],
            'medical_technologist' => ['required', 'exists:users,id'],
            'pathologist' => ['required', 'exists:users,id'],
            'ward' => ['nullable'],
            'or_no' => ['nullable', 'numeric', 'exists:payments,or_no', Rule::unique('hematology_records')->ignore($id)],
            'status' => ['required', 'in:pending,processing'],
            // hematology
            'hemoglobin' => ['required', 'numeric'],
            'hematocrit' => ['required', 'numeric'],
            'wbc' => ['required', 'numeric'],
            'rbc' => ['required', 'numeric'],
            'platelet_count' => ['required', 'numeric'],
            'segmenters' => ['required', 'numeric'],
            'lymphocyte' => ['required', 'numeric'],
            'monocyte' => ['required', 'numeric'],
            'blood_type' => ['required', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            // hematology record
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Patient ID does not exist',
            'age.numeric' => 'Invalid format',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'or_no.numeric' => 'Must be a number.',
            'or_no.unique' => 'OR number already exists',
            'or_no.exists' => 'OR number does not exist',
            'rqst_physician.required' => 'Required field',
            'rqst_physician.exists' => 'Physician ID does not exist',
            'medical_technologist.required' => 'Required field',
            'medical_technologist.exists' => 'Medical Technologist ID does not exist',
            'pathologist.required' => 'Required field',
            'pathologist.exists' => 'Pathologist ID does not exist',
            'remarks.string' => 'Must be a string.',
            'status.required' => 'Required field',
            'status.string' => 'Must be a string.',
            'status.in' => 'Invalid value',
            // hematology
            'hemoglobin.required' => 'Required field',
            'hemoglobin.numeric' => 'Must be a number.',
            'hematocrit.required' => 'Required field',
            'hematocrit.numeric' => 'Must be a number.',
            'wbc.required' => 'Required field',
            'wbc.numeric' => 'Must be a number.',
            'rbc.required' => 'Required field',
            'rbc.numeric' => 'Must be a number.',
            'platelet_count.required' => 'Required field',
            'platelet_count.numeric' => 'Must be a number.',
            'segmenters.required' => 'Required field',
            'segmenters.numeric' => 'Must be a number.',
            'lymphocyte.required' => 'Required field',
            'lymphocyte.numeric' => 'Must be a number.',
            'monocyte.required' => 'Required field',
            'monocyte.numeric' => 'Must be a number.',
            'blood_type.required' => 'Required field',
            'blood_type.string' => 'Must be a string.',
            'diagnosis.string' => 'Must be a string.',
            'diagnosis.required' => 'Required field',
        ];
    }
}
