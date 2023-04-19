<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\UserAccount;
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

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'],
                'last_name' => $input['last_name'],
                'suffix' => $input['suffix'],
                'birthdate' => $input['birthdate'],
                'age' => $input['age'],
                'sex' => $input['sex'],
                'role' => $input['role'],
                'specialization' => $input['specialization'],
                'curr_position' => $input['position'],
                'license_no' => $input['license'],
                'landline' => $input['landline'],
                'mobile' => $input['mobile'],
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return $user;
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
            'age' => ['required','int'],
            'sex' => ['required'],
            'specialization' => ['nullable','string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'license_no' => ['nullable','string', 'max:255', 'unique:user_accounts'],
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
            'email.required' => 'Email is required.',
            'email.string' => 'Must be a string.',
            'email.max' => 'Must be less than 255 characters.',
            'email.email' => 'Must be a valid email address.',
            'email.unique' => 'Email is already taken.',
            'password.required' => 'Password is required.',
            'password.string' => 'Must be a string.',
            'password.min' => 'Must be at least 8 characters.',
            'password.confirmed' => 'Password does not match.',
            'first_name.required' => 'First name is required.',
            'first_name.string' => 'Must be a string.',
            'first_name.max' => 'Must be less than 255 characters.',
            'middle_name.string' => 'Must be a string.',
            'middle_name.max' => 'Must be less than 255 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'Must be a string.',
            'last_name.max' => 'Must be less than 255 characters.',
            'suffix.string' => 'Must be a string.',
            'suffix.max' => 'Must be less than 255 characters.',
            'birthdate.required' => 'Birthdate is required.',
            'birthdate.date' => 'Invalid date format e.g.(yyyy-mm-dd).',
            'age.required' => 'Age is required.',
            'age.number' => 'Must be a valid positve integer.',
            'sex.required' => 'Sex is required.',
            'specialization.string' => 'Must be a string.',
            'specialization.max' => 'Must be less than 255 characters.',
            'position.required' => 'Position is required.',
            'position.string' => 'Must be a string.',
            'position.max' => 'Must be less than 255 characters.',
            'license_no.string' => 'Must be a string',
            'license_no.max' => 'Must be less than 255 characters.',
            'license_no.unique' => 'License number already exists.',
            'telephone.string' => 'Must be a string.',
            'telephone.max' => 'Must be less than 255 characters.',
            'mobile.string' => 'Must be a string.',
            'mobile.max' => 'Must be less than 255 characters.',
        ];
    }
}
