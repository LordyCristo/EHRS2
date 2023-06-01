<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FecalysisRequest extends FormRequest
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
            //fecalysis record
            'infirmary_id' => ['required', 'exists:clients,infirmary_id'],
            'age' => ['nullable','numeric'],
            'sex' => ['required','in:male,female'],
            'ward' => ['nullable'],
            'or_no' => ['nullable', 'numeric', 'exists:payments,or_no', Rule::unique('fecalysis_records')->ignore($id)],
            'rqst_physician' => ['required', 'exists:users,id'],
            'medical_technologist' => ['required', 'exists:users,id'],
            'pathologist' => ['required', 'exists:users,id'],
            'hospital_no' => ['nullable'],
            'status' => ['required', 'in:Pending,Processing,Done,Cancelled,Released'],
            //fecalysis
            'color' => ['required', 'string'],
            'consistency' => ['required', 'string'],
            'ova' => ['required', 'string'],
            'wbc' => ['required', 'numeric'],
            'rbc' => ['required', 'numeric'],
            'fat_globules' => ['required', 'numeric'],
            'others' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            //fecalysis record
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Patient ID does not exist',
            'age.numeric' => 'Invalid Format',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'or_no.numeric' => 'Invalid format',
            'or_no.exists' => 'OR number does not exist',
            'or_no.unique' => 'OR number already exists',
            'rqst_physician.required' => 'Required field',
            'rqst_physician.exists' => 'Physician does not exist',
            'medical_technologist.required' => 'Required field',
            'medical_technologist.exists' => 'Medical technologist does not exist',
            'pathologist.required' => 'Required field',
            'pathologist.exists' => 'Pathologist does not exist',
            'status.required' => 'Required field',
            'status.in' => 'Invalid value',
            //fecalysis
            'color.required' => 'Required field',
            'consistency.required' => 'Required field',
            'ova.required' => 'Required field',
            'wbc.required' => 'Required field',
            'wbc.numeric' => 'Invalid format',
            'rbc.required' => 'Required field',
            'rbc.numeric' => 'Invalid format',
            'fat_globules.required' => 'Required field',
            'fat_globules.numeric' => 'Invalid format',
            'others.required' => 'Required field',
            'remarks.required' => 'Required field',
        ];
    }
}
