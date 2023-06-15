<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UrinalysisRequest extends FormRequest
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
            //urinalysis record
            'infirmary_id' => ['required', 'exists:clients,infirmary_id'],
            'rqst_physician' => ['required', 'exists:users,id'],
            'medical_technologist' => ['required', 'exists:users,id'],
            'pathologist' => ['required', 'exists:users,id'],
            'or_no' => ['nullable', 'numeric', 'exists:payments,or_no', Rule::unique('urinalysis_records')->ignore($id)],
            'ward' => ['required', 'in:opd,er,male-ward,female-ward,pedia-ward,iso-1,iso-2'],
            'status' => ['required', 'in:pending,done,released'],
            // urinalysis
            'color' => ['required', 'string'],
            'clarity' => ['required', 'string', 'in:clear,slightly-turbid,turbid'],
            'ph' => ['required', 'numeric', 'between:0,14'],
            'specific_gravity' => ['required', 'numeric'],
            'albumin' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'glucose' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'blood' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'leukocytes' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'nitrite' => ['required', 'in:positive,negative'],
            'bilirubin' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'urobilinogen' => ['required', 'in:increased,normal,decreased,negative'],
            'ketones' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'wbc' => ['required', 'in:0-2,0-5,6-10,11-20,21-50,51-100,>100'],
            'rbc' => ['required', 'in:0-2,0-5,6-10,11-20,21-50,51-100,>100'],
            'epithelial_cells' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'bacteria' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'amorphous_urates' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'amorphous_phosphates' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'mucous_threads' => ['required', 'in:positive,negative,trace,1+,2+,3+,4+'],
            'crystals' => ['nullable', 'string'],
            'cast' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            //fecalysis record
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Patient ID does not exist',
            'ward.required' => 'Required field',
            'age.numeric' => 'Invalid format',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'or_no.numeric' => 'Must be a number.',
            'or_no.unique' => 'OR No. already used',
            'or_no.exists' => 'OR No. does not exist',
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
            // fecalysis
            'color.required' => 'Required field',
            'color.string' => 'Must be a string.',
            'clarity.required' => 'Required field',
            'clarity.string' => 'Must be a string',
            'ph.required' => 'Required field',
            'ph.between' => 'Must be between 0 and 14',
            'ph.numeric' => 'Must be a number',
            'specific_gravity.required' => 'Required field',
            'specific_gravity.numeric' => 'Must be a number',
            'albumin.required' => 'Required field',
            'albumin.in' => 'Invalid value',
            'glucose.required' => 'Required field',
            'glucose.in' => 'Invalid value',
            'blood.required' => 'Required field',
            'blood.in' => 'Invalid value',
            'leukocytes.required' => 'Required field',
            'leukocytes.in' => 'Invalid value',
            'nitrite.required' => 'Required field',
            'nitrite.in' => 'Invalid value',
            'bilirubin.required' => 'Required field',
            'bilirubin.in' => 'Invalid value',
            'urobilinogen.required' => 'Required field',
            'urobilinogen.in' => 'Invalid value',
            'ketones.required' => 'Required field',
            'ketones.in' => 'Invalid value',
            'wbc.required' => 'Required field',
            'wbc.in' => 'Invalid value',
            'rbc.required' => 'Required field',
            'rbc.in' => 'Invalid value',
            'epithelial_cells.required' => 'Required field',
            'epithelial_cells.in' => 'Invalid value',
            'bacteria.required' => 'Required field',
            'bacteria.in' => 'Invalid value',
            'amorphous_urates.required' => 'Required field',
            'amorphous_urates.in' => 'Invalid value',
            'amorphous_phosphates.required' => 'Required field',
            'amorphous_phosphates.in' => 'Invalid value',
            'mucous_threads.required' => 'Required field',
            'mucous_threads.in' => 'Invalid value',
            'crystals.string' => 'Must be a string.',
            'cast.string' => 'Must be a string',
            'remarks.string' => 'Must be a string',
        ];
    }
}
