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
            'ward' => ['required'],
            'or_no' => ['nullable', 'numeric', 'exists:payments,or_no', Rule::unique('hematology_records')->ignore($id)],
            'status' => ['required', 'in:pending,done,released'],
            // hematology
            'hemoglobin' => ['required', 'numeric','min:11.0','max:22.0'],
            'hematocrit' => ['required', 'numeric','min:0.35','max:0.55'],
            'wbc' => ['required', 'numeric','min:4.0','max:22.0'],
            'rbc' => ['required', 'numeric','min:3.5','max:7.0'],
            'platelet_count' => ['required', 'numeric','min:150','max:450'],
            'segmenters' => ['required', 'numeric','min:0.5','max:0.7'],
            'lymphocyte' => ['required', 'numeric','min:0.2','max:0.4'],
            'monocyte' => ['required', 'numeric','min:0.01','max:0.15'],
            'blood_type' => ['required', 'string','in:O+,O-,A+,A-,B+,B-,AB+,AB-'],
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
            'hemoglobin.min' => 'Must be at least 11.0',
            'hemoglobin.max' => 'Must be at most 22.0',
            'hematocrit.required' => 'Required field',
            'hematocrit.numeric' => 'Must be a number.',
            'hematocrit.min' => 'Must be at least 0.35',
            'hematocrit.max' => 'Must be at most 0.55',
            'wbc.required' => 'Required field',
            'wbc.numeric' => 'Must be a number.',
            'wbc.min' => 'Must be at least 4.0',
            'wbc.max' => 'Must be at most 22.0',
            'rbc.required' => 'Required field',
            'rbc.numeric' => 'Must be a number.',
            'rbc.min' => 'Must be at least 3.5',
            'rbc.max' => 'Must be at most 7.0',
            'platelet_count.required' => 'Required field',
            'platelet_count.numeric' => 'Must be a number.',
            'platelet_count.min' => 'Must be at least 150',
            'platelet_count.max' => 'Must be at most 450',
            'segmenters.required' => 'Required field',
            'segmenters.numeric' => 'Must be a number.',
            'segmenters.min' => 'Must be at least 0.5',
            'segmenters.max' => 'Must be at most 0.7',
            'lymphocyte.required' => 'Required field',
            'lymphocyte.numeric' => 'Must be a number.',
            'lymphocyte.min' => 'Must be at least 0.2',
            'lymphocyte.max' => 'Must be at most 0.4',
            'monocyte.required' => 'Required field',
            'monocyte.numeric' => 'Must be a number.',
            'monocyte.min' => 'Must be at least 0.01',
            'monocyte.max' => 'Must be at most 0.15',
            'blood_type.required' => 'Required field',
            'blood_type.string' => 'Must be a string.',
            'blood_type.in' => 'Invalid value',
        ];
    }
}
