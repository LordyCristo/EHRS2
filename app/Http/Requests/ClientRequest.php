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
        // return auth()->check();
        // only user where role is is nurse, admin, or doctor can access this
        //return auth()->check() && in_array(auth()->user()->role, [1,2,3,4]);
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
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'age' => 'nullable|int',
            'sex' => 'required|in:`male`,`female`',
            'phone' => 'nullable|string|max:255|unique:clients,phone',
            'email_address' => 'nullable|email|max:255',
            'home_address' => 'nullable|string|max:255',
            'curr_address' => 'nullable|string|max:255',
            'id_number' => 'nullable|string|max:255',
            'civil_status' => 'required|in:`single`,`married`,`widowed`,`separated`,`divorced`',
            'program_id' => 'nullable|exists:degree_programs,id',
            'year_lvl' => 'nullable|int',
            'client_type_id' => 'required|exists:client_types,id',
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
            'middle_name.string' => 'Middle name must be a string',
            'middle_name.max' => 'Middle name must not exceed 255 characters',
            'last_name.required' => 'Last name is required',
            'last_name.string' => 'Last name must be a string',
            'last_name.max' => 'Last name must not exceed 255 characters',
            'suffix.string' => 'Suffix must be a string',
            'suffix.max' => 'Suffix must not exceed 255 characters',
            'birthdate.required' => 'Birthdate is required',
            'birthdate.date' => 'Birthdate must be a date',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'First name',
            'middle_name' => 'Middle name',
            'last_name' => 'Last name',
            'suffix' => 'Suffix',
            'birthdate' => 'Birthdate',
            'age' => 'Age',
            'sex' => 'Gender',
            'phone' => 'Phone number',
            'email_address' => 'Email address',
            'home_address' => 'Home address',
            'curr_address' => 'Current address',
            'id_number' => 'ID number',
            'civil_status' => 'Civil status',
            'program_id' => 'Program',
            'year_lvl' => 'Year level',
            'client_type_id' => 'Client type',
        ];
    }
}
