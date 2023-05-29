<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DegreeProgramRequest extends FormRequest
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
        // assuming that the route request parameter name is degree_program: http://
        $id = $this->route('id');
        return [
            'name' => ['required', 'max:255'],
            'abbr' => ['required', 'max:255', Rule::unique('degree_programs','abbr')->ignore($id)],
            'major' => ['nullable', 'max:255', Rule::unique('degree_programs','major')->ignore($id)],
            'group' => ['required', 'max:255', 'in:bachelor,master,doctor'],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * @return string[]
     */
    function messages(): array
    {
        return [
            'name.required' => 'Required field',
            'name.max' => 'Too long',
            'abbr.required' => 'Required field',
            'abbr.unique' => 'Already exists',
            'abbr.max' => 'Too long',
            'major.max' => 'Too long',
            'group.required' => 'Required field',
            'group.in' => 'Invalid value',
            'department_id.required' => 'Required field',
            'department_id.exists' => 'Invalid value',
        ];
    }
}
