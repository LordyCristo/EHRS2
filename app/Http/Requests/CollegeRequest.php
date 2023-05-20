<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|unique:colleges|max:255',
            'abbr' => 'required|unique:colleges|max:255',
            'is_active' => 'required|boolean',
        ];
    }

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
}
