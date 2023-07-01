<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DentalTreatmentRequest extends FormRequest
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
            'dental_record_id' => ['required', 'exists:dental_records,id'],
            'diagnosis' => ['required', 'string'],
            'service_id' => ['required', 'string'],
            'tooth_location' => ['required', 'string'],
            'operator' => ['required', 'string']
        ];
    }
}
