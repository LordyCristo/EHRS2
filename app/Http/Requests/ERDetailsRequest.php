<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ERDetailsRequest extends FormRequest
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
            'client_id' => ['nullable', 'exists:clients,infirmary_id'],
            'date_admitted' => ['nullable', 'date'],
            'time_admitted' => ['nullable', 'date_format:H:i'],
            'brought_by' => ['nullable', 'string'],
            'arrival_condition' => ['nullable', 'string'],
            'temperature' => ['nullable', 'numeric'],
            'temperature_location' => ['nullable', 'string'],
            'weight' => ['nullable', 'numeric'],
            'pulse_rate' => ['nullable', 'numeric'],
            'blood_pressure' => ['nullable', 'string'],
            'cardiac_rate' => ['nullable', 'numeric'],
            'respiratory_rate' => ['nullable', 'numeric'],
            'oxygen_saturation' => ['nullable', 'numeric'],
            'chief_complaint' => ['nullable', 'string'],
            'allergies' => ['nullable', 'string'],
            'physical_exam' => ['nullable', 'string'],
            'current_medications' => ['nullable', 'string'],
            'treatment' => ['nullable', 'string'],
            'nurse_notes' => ['nullable', 'string'],
            'diagnosis' => ['nullable', 'string'],
            'disposition' => ['nullable', 'string'],
            'date_disposition' => ['nullable', 'date'],
            'time_disposition' => ['nullable', 'date_format:H:i'],
            'discharge_condition' => ['nullable', 'string'],
            'attending_nurse' => ['nullable', 'string'],
            'attending_physician' => ['nullable', 'string'],
        ];
    }
}
