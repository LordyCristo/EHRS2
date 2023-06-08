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
            'rqst_physician' => ['required', 'exists:users,id'],
            'medical_technologist' => ['required', 'exists:users,id'],
            'pathologist' => ['required', 'exists:users,id'],
            'or_no' => ['nullable', 'numeric', 'exists:payments_service,payment_id', Rule::unique('fecalysis_records','or_no')->ignore($id)],
            'ward' => ['required'],
            'status' => ['required', 'in:pending,done,released'],
            //fecalysis
            'color' => ['required', 'string'],
            'consistency' => ['required', 'in:soft,loose,watery,formed,hard'],
            'ova' => ['nullable', 'string'],
            'wbc' => ['required', 'in:0-2,0-5,6-10,11-20,21-50,51-100,>100'],
            'rbc' => ['required', 'in:0-2,0-5,6-10,11-20,21-50,51-100,>100'],
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
            'or_no.numeric' => 'Invalid format',
            'or_no.exists' => 'OR no. does not exist',
            'or_no.unique' => 'OR no. is already used',
            'ward.required' => 'Required field',
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
            'wbc.in' => 'Invalid value',
            'wbc.numeric' => 'Invalid format',
            'rbc.required' => 'Required field',
            'rbc.numeric' => 'Invalid format',
            'rbc.in' => 'Invalid value',
            'fat_globules.required' => 'Required field',
            'fat_globules.numeric' => 'Invalid format',
        ];
    }
}
