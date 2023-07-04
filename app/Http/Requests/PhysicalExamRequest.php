<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhysicalExamRequest extends FormRequest
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
            //student
            'examiner' => ['nullable', 'exists:users,id'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'blood_pressure' => ['nullable', 'string'],
            'pulse' => ['nullable', 'string'],
            'prev_illns_oprtn' => ['nullable', 'string'],
            'immnztn_vccntn' => ['nullable', 'string'],
            'head_neck' => ['nullable', 'string'],
            'scalp_face' => ['nullable', 'string'],
            'neck_thyroid' => ['nullable', 'string'],
            'lymph_glands' => ['nullable', 'string'],
            'vision_with_glasses' => ['nullable', 'string'],
            'vision_without_glasses' => ['nullable', 'string'],
            'mouth_throat_tonsils' => ['nullable', 'string'],
            'mouth_throat_teeth' => ['nullable', 'string'],
            'heart' => ['nullable', 'string'],
            'lung' => ['nullable', 'string'],
            'abdomen_tenderness' => ['nullable', 'string'],
            'abdomen_mass' => ['nullable', 'string'],
            'abdomen_scars' => ['nullable', 'string'],
            'abdomen_rep_organ' => ['nullable', 'string'],
            'spine_extrts_deformities' => ['nullable', 'string'],
            'spine_extrts_varicosities' => ['nullable', 'string'],
            'spine_extrts_feet' => ['nullable', 'string'],
            'skin_diseases' => ['nullable', 'string'],
            //outpatient
            'history' => ['nullable', 'string'],
            'treatment' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'form_type' => ['required', 'in:student,outpatient,er'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'infirmary_id.required' => 'Required field',
            'infirmary_id.exists' => 'Infirmary ID does not exist',
            'examiner.required' => 'Required field',
            'examiner.exists' => 'Examiner does not exist',
            'weight.required' => 'Required field',
            'weight.numeric' => 'Weight must be a number',
            'height.required' => 'Required field',
            'height.numeric' => 'Height must be a number',
            'blood_pressure.required' => 'Required field',
            'blood_pressure.numeric' => 'Blood pressure must be a number',
            'pulse.required' => 'Required field',
            'pulse.numeric' => 'Pulse must be a number',
            'prev_illns_oprtn.string' => 'Must be a string',
            'immnztn_vccntn.string' => 'Must be a string',
            'head_neck.string' => 'Must be a string',
            'scalp_face.string' => 'Must be a string',
            'neck_thyroid.string' => 'Must be a string',
            'lymph_glands.string' => 'Must be a string',
            'vision_with_glasses.string' => 'Must be a string',
            'vision_without_glasses.string' => 'Must be a string',
            'mouth_throat_tonsils.string' => 'Must be a string',
            'mouth_throat_teeth.string' => 'Must be a string',
            'heart.string' => 'Must be a string',
            'lung.string' => 'Must be a string',
            'abdomen_tenderness.string' => 'Must be a string',
            'abdomen_mass.string' => 'Must be a string',
            'abdomen_scars.string' => 'Must be a string',
            'abdomen_rep_organ.string' => 'Must be a string',
            'spine_extrts_deformities.string' => 'Must be a string',
            'spine_extrts_varicosities.string' => 'Must be a string',
            'spine_extrts_feet.string' => 'Must be a string',
            'skin_diseases.string' => 'Must be a string',
            'remarks.string' => 'Must be a string',
        ];
    }
}
