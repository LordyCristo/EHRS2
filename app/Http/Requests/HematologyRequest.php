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
            'client_id' => ['required', 'exists:clients,id'],
            'age' => ['nullable','numeric'],
            'sex' => ['required','in:male,female'],
            'ward' => ['nullable', 'string'],
            'or_no' => ['required', 'numeric', Rule::unique('hematology_records')->ignore($id)],
            'rqst_physician' => ['required', 'exists:users,id'],
            'hospital_no' => ['nullable', 'string'],
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
            'diagnosis' => ['required', 'string'],
            'remarks' => ['nullable', 'string'],
            'status' => ['required', 'in:Pending,Processing,Done,Cancelled,Released'],
        ];
    }

    public function messages(): array
    {
        return [
            // hematology record
            'client_id.required' => 'Required field',
            'client_id.exists' => 'Patient ID does not exist',
            'age.numeric' => 'Invalid format',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'ward.string' => 'Must be a string.',
            'or_no.required' => 'Required field',
            'or_no.numeric' => 'Must be a number.',
            'or_no.unique' => 'OR number already exists',
            'rqst_physician.required' => 'Required field',
            'rqst_physician.exists' => 'Physician ID does not exist',
            'hospital_no.string' => 'Must be a string.',
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
            'remarks.string' => 'Must be a string.',
            'status.required' => 'Required field',
            'status.string' => 'Must be a string.',
            'status.in' => 'Invalid value',
            'diagnosis.required' => 'Required field',
        ];
    }
}
