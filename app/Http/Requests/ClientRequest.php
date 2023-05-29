<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'infirmary_id' => ['required', 'int', Rule::unique('clients','infirmary_id')->ignore($id)],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'int'],
            'sex' => ['required'],
            'civil_status' => ['required'],
            'phone' => ['required', 'string', Rule::unique('clients', 'phone')->ignore($id), 'starts_with:09', 'size:11'],
            'email_address' => ['required', 'string', 'email', 'max:255', Rule::unique('clients', 'email_address')->ignore($id)],
            'home_address' => ['nullable', 'string', 'max:255'],
            'curr_address' => ['nullable', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]{2}-[0-9]{1}-[0-9]{5}$/', Rule::unique('clients', 'id_number')->ignore($id)],
            'program_id' => ['required', 'exists:degree_programs,id'],
            'year_lvl' => ['nullable'],
            'client_type_id' => ['required', 'exists:client_types,id'],
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
            'infirmary.required' => 'Required field',
            'infirmary.int' => 'Invalid format',
            'infirmary.unique' => 'Already exists',
            'first_name.required' => 'Required field',
            'first_name.string' => 'Invalid input',
            'first_name.max' => 'Too long',
            'middle_name.string' => 'Invalid input',
            'middle_name.max' => 'Too long',
            'last_name.required' => 'Required field',
            'last_name.string' => 'Invalid input',
            'last_name.max' => 'Too long',
            'suffix.string' => 'Invalid input',
            'suffix.max' => 'Too long',
            'birthdate.required' => 'Required field',
            'birthdate.date' => 'Invalid date',
            'age.int' => 'Invalid input',
            'age.required' => 'Required field',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'civil_status.required' => 'Required field',
            'civil_status.in' => 'Invalid value',
            'phone.string' => 'Invalid input',
            'phone.max' => 'Too long',
            'phone.unique' => 'Already exists',
            'phone.required' => 'Required field',
            'phone.starts_with' => 'Invalid format',
            'phone.size' => 'Too long',
            'email_address.email' => 'Invalid email address',
            'email_address.max' => 'Too long',
            'email_address.unique' => 'Already exists',
            'email_address.required' => 'Required field',
            'home_address.string' => 'Invalid input',
            'home_address.max' => 'Too long',
            'curr_address.string' => 'Invalid input',
            'curr_address.max' => 'Too long',
            'id_number.string' => 'Invalid input',
            'id_number.max' => 'Too long',
            'id_number.unique' => 'Already exists',
            'id_number.required' => 'Required field',
            'id_number.regex' => 'Invalid format',
            'program_id.required' => 'Required field',
            'program_id.exists' => 'Invalid input',
            'client_type_id.required' => 'Required field',
            'client_type_id.exists' => 'Invalid input',
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
            'infirmary_id' => 'Infirmary ID',
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
