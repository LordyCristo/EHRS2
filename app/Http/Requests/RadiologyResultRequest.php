<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RadiologyResultRequest extends FormRequest
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
            'rqst_id' => ['required', 'integer', 'exists:xray_requests,id', Rule::unique('xrays')->ignore($id)],
            'procedure' => ['required'],
            'impression' => ['required', 'string'],
            'radiographic_findings' => ['required', 'string'],
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
            'rqst_id.required' => 'Required field',
            'rqst_id.integer' => 'Invalid value',
            'rqst_id.exists' => 'Do not exist value',
            'rqst_id.unique' => 'Already taken',
            'procedure.required' => 'Required field',
            'procedure.string' => 'Invalid value',
            'impression.required' => 'Required field',
            'impression.string' => 'Invalid value',
            'radiographic_findings.string' => 'Invalid value',
            'radiographic_findings.required' => 'Required field',
            'rad_tech_id.required' => 'Required field',
            'rad_tech_id.integer' => 'Invalid value',
            'rad_tech_id.exists' => 'Do not exist value',
            'radiologist_id.required' => 'Required field',
            'radiologist_id.integer' => 'Invalid value',
            'radiologist_id.exists' => 'Do not exist value',
            'image.image' => 'Not an image file',
            'image.mimes' => 'Invalid file extension',
            'image.max' => 'Too big file size',
        ];
    }
}
