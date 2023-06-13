<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name' => ['required', 'string', 'max:255', 'unique:services,name,' . $id ],
            'description' => ['nullable', 'string'],
            'schedule' => ['nullable', 'string'],
            'section_name' => ['required', 'string'],
            'room_no' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Required field',
            'name.string' => 'Must be a string.',
            'name.max' => 'Too long',
            'name.unique' => 'Already exists',
            'description.string' => 'Must be a string.',
            'schedule.string' => 'Must be a string.',
            'section_name.string' => 'Must be a string.',
            'section_name.required' => 'Required field',
            'room_no.string' => 'Must be a string.',
        ];
    }
}
