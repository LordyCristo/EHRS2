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
            //check if rows is not empty
            'rows' => ['required', 'array', 'min:1'],
            //check if rows is an array of objects
            'rows.*' => ['required', 'array'],
            //check if rows is an array of objects with the following keys
            'rows.*.diagnosis' => ['required', 'string'],
            'rows.*.service_id' => ['required', 'string'],
            'rows.*.tooth_location' => ['required', 'string'],
            'rows.*.operator' => ['required', 'string'],
        ];
    }
}
