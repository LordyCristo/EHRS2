<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            // 'middle_name' => 'nullable|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'suffix' => 'nullable|string|max:255',
            // 'birthdate' => 'required|date',
            // 'age' => 'nullable|int',
            // 'sex' => 'required|in:`male`,`female`',
            //'phone' => 'nullable|string|max:255|regex:/^(\+63|0)[0-9]{10}$/',
            // 'email_address' => 'nullable|email|max:255',
            // 'home_address' => 'nullable|string|max:255',
            // 'curr_address' => 'nullable|string|max:255',
            // 'id_number' => 'nullable|string|max:255',
            // 'civil_status' => 'required|in:`single`,`married`,`widowed`,`separated`,`divorced`',
            // 'program_id' => 'nullable|exists:degree_programs,id',
            // 'year_lvl' => 'nullable|int',
            // 'client_type_id' => 'required|exists:client_types,id',
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
            'first_name.required' => 'First name is required',
            'first_name.string' => 'First name must be a string',
            'first_name.max' => 'First name must not exceed 255 characters',
        ];
    }
}
