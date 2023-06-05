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
            'ward' => ['nullable'],
            'status' => ['required', 'in:pending,released'],
            // urinalysis
            'color' => ['required', 'string'],
            'clarity' => ['required', 'string'],
            'ph' => ['required', 'numeric'],
            'specific_gravity' => ['required', 'numeric'],
            'albumin' => ['required', 'string'],
            'glucose' => ['required', 'string'],
            'blood' => ['required', 'string'],
            'leukocytes' => ['required', 'string'],
            'nitrite' => ['required', 'string'],
            'bilirubin' => ['required', 'string'],
            'urobilinogen' => ['required', 'string'],
            'ketones' => ['required', 'string'],
            'wbc' => ['required', 'numeric'],
            'rbc' => ['required', 'numeric'],
            'epithelial_cells' => ['required', 'string'],
            'bacteria' => ['required', 'string'],
            'amorphous_urates' => ['required', 'string'],
            'amorphous_phosphates' => ['required', 'string'],
            'mucous_threads' => ['required', 'string'],
            'crystals' => ['required', 'string'],
            'cast' => ['required', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            //fecalysis record
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
            // fecalysis
            'color.required' => 'Required field',
            'color.string' => 'Must be a string',
            'clarity.required' => 'Required field',
            'clarity.string' => 'Must be a string',
            'ph.required' => 'Required field',
            'ph.numeric' => 'Must be a number',
            'specific_gravity.required' => 'Required field',
            'specific_gravity.numeric' => 'Must be a number',
            'albumin.required' => 'Required field',
            'albumin.string' => 'Must be a string',
            'glucose.required' => 'Required field',
            'glucose.string' => 'Must be a string',
            'blood.required' => 'Required field',
            'blood.string' => 'Must be a string',
            'leukocytes.required' => 'Required field',
            'leukocytes.string' => 'Must be a string',
            'nitrite.required' => 'Required field',
            'nitrite.string' => 'Must be a string',
            'bilirubin.required' => 'Required field',
            'bilirubin.string' => 'Must be a string',
            'urobilinogen.required' => 'Required field',
            'urobilinogen.string' => 'Must be a string',
            'ketones.required' => 'Required field',
            'ketones.string' => 'Must be a string',
            'wbc.required' => 'Required field',
            'wbc.numeric' => 'Must be a number',
            'rbc.required' => 'Required field',
            'rbc.numeric' => 'Must be a number',
            'epithelial_cells.required' => 'Required field',
            'epithelial_cells.string' => 'Must be a string',
            'bacteria.required' => 'Required field',
            'bacteria.string' => 'Must be a string',
            'amorphous_urates.required' => 'Required field',
            'amorphous_urates.string' => 'Must be a string',
            'amorphous_phosphates.required' => 'Required field',
            'amorphous_phosphates.string' => 'Must be a string',
            'mucous_threads.required' => 'Required field',
            'mucous_threads.string' => 'Must be a string',
            'crystals.required' => 'Required field',
            'crystals.string' => 'Must be a string',
            'cast.required' => 'Required field',
            'cast.string' => 'Must be a string',
        ];
    }
}
