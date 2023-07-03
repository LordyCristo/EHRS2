<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DentalCertifcateRequest extends FormRequest
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
            'dentist' => 'required|exists:users,id',
            'infirmary_id' => 'required|exists:clients,infirmary_id',
            'or_no' => 'required|exists:payments,or_no',
            'diagnosis' => 'required|string',
            'num_days' => 'required|integer',
            'admission_date' => 'required|date',
            'discharge_date' => 'required|date',
            'remarks' => 'nullable|string',
        ];
    }
}
