<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        //This is the real create function that makes a new user account
        Validator::make($input, $this->rules(), $this->messages())->validate();
        return User::create([
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'suffix' => $input['suffix'],
            'birthdate' => $input['birthdate'],
            'age' => $input['age'],
            'sex' => $input['sex'],
            'telephone' => $input['telephone'],
            'mobile' => $input['mobile'],
            'specialization' => $input['specialization'],
            'curr_position' => $input['position'],
            'license_no' => $input['license_no'],
            'role' => $input['role'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }

    /**
     * Get the defined validation rules.
     *
     * @return array
     */
    function rules(){
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable','string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable','string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'age' => ['required','int','min:18'],
            'sex' => ['required'],
            'specialization' => ['nullable','string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'license_no' => ['nullable','string', 'max:255', 'unique:users'],
            'telephone' => ['nullable','string', 'max:255'],
            'mobile' => ['required','string', 'max:255'],
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(){
        return [
            'email.required' => 'Required field',
            'email.string' => 'Invalid email',
            'email.email' => 'Invalid email',
            'email.max' => 'Invalid email',
            'email.unique' => 'Email already exists',
            'password.required' => 'Required field',
            'password.string' => 'Invalid password',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password does not match',
            'terms.accepted' => 'Required field',
            'terms.required' => 'Required field',
            'first_name.required' => 'Required field',
            'first_name.string' => 'Invalid first name',
            'first_name.max' => 'Invalid first name',
            'middle_name.string' => 'Invalid middle name',
            'middle_name.max' => 'Invalid middle name',
            'last_name.required' => 'Required field',
            'last_name.string' => 'Invalid last name',
            'last_name.max' => 'Invalid last name',
            'suffix.string' => 'Invalid suffix',
            'suffix.max' => 'Invalid suffix',
            'birthdate.required' => 'Required field',
            'birthdate.date' => 'Invalid birthdate',
            'age.required' => 'Required field',
            'age.int' => 'Invalid age',
            'age.min' => 'Must be at least 18 years old',
            'sex.required' => 'Required field',
            'specialization.string' => 'Invalid specialization',
            'specialization.max' => 'Invalid specialization',
            'position.required' => 'Required field',
            'position.string' => 'Invalid position',
            'position.max' => 'Invalid position',
            'role.required' => 'Required field',
            'license_no.required' => 'Required field',
            'license_no.string' => 'Invalid license number',
            'license_no.max' => 'Invalid license number',
            'license_no.unique' => 'License number already exists',
            'telephone.string' => 'Invalid telephone number',
            'telephone.max' => 'Invalid telephone number',
            'mobile.required' => 'Required field',
            'mobile.string' => 'Invalid mobile number',
            'mobile.max' => 'Invalid mobile number',
        ];
    }
}
