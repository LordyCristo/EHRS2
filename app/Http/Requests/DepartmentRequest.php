<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
        // assuming that the route request parameter name is department: http://127.0.0.1:8000/more/departments/{department}
        $departId = $this->route('id');
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('departments','name')->ignore($departId)],
            'abbr' => ['required', 'string', 'max:255', Rule::unique('departments','abbr')->ignore($departId)],
            'college_id' => ['required', 'integer', 'exists:colleges,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Required field',
            'name.string' => 'Must be a string.',
            'name.max' => 'Too long',
            'name.unique' => 'Already exists',
            'abbr.required' => 'Required field',
            'abbr.string' => 'Must be a string.',
            'abbr.max' => 'Too long',
            'abbr.unique' => 'Already exists',
            'college_id.required' => 'Required field',
            'college_id.integer' => 'Must be an integer.',
            'college_id.exists' => 'Invalid value',
        ];
    }
}
