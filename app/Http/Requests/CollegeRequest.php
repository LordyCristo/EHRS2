<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed route
 */
class CollegeRequest extends FormRequest
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
        // assuming that the route request parameter name is college: http://127.0.0.1:8000/more/colleges/{college}
        $collegeId = $this->route('college');
        return [
            'name' => ['required', 'max:255', Rule::unique('colleges','name')->ignore($collegeId)],
            'abbr' => ['required', 'max:255', Rule::unique('colleges','abbr')->ignore($collegeId)],
            'is_active' => ['required', 'boolean'],
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
            'name.unique' => 'Already exists',
            'name.max' => 'Too long',
            'abbr.required' => 'Required field',
            'abbr.unique' => 'Already exists',
            'abbr.max' => 'Too long',
            'is_active.required' => 'Required field',
            'is_active.boolean' => 'Invalid value',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'name' => 'College name',
            'abbr' => 'Abbreviation',
            'is_active' => 'Status',
        ];
    }
}
