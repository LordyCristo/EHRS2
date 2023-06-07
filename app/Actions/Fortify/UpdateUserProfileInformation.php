<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable','string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable','string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'age' => ['required','int'],
            'sex' => ['nullable','string', 'max:255'],
            'specialization' => ['nullable','string', 'max:255'],
            'curr_position' => ['nullable','string', 'max:255'],
            'license_no' => ['nullable','string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'telephone' => ['nullable','string', 'max:255'],
            'mobile' => ['required','string', 'max:255'],
        ],[
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
            'sex.required' => 'Required field',
            'specialization.string' => 'Invalid specialization',
            'specialization.max' => 'Invalid specialization',
            'position.required' => 'Required field',
            'position.string' => 'Invalid position',
            'position.max' => 'Invalid position',
            'license_no.required' => 'Required field',
            'license_no.string' => 'Invalid license number',
            'license_no.max' => 'Invalid license number',
            'license_no.unique' => 'License number already exists',
            'telephone.string' => 'Invalid telephone number',
            'telephone.max' => 'Invalid telephone number',
            'mobile.required' => 'Required field',
            'mobile.string' => 'Invalid mobile number',
            'mobile.max' => 'Invalid mobile number',
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'email' => $input['email'],
                'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'],
                'last_name' => $input['last_name'],
                'suffix' => $input['suffix'],
                'birthdate' => $input['birthdate'],
                'age' => $input['age'],
                'sex' => $input['sex'],
                'specialization' => $input['specialization'],
                'curr_position' => $input['curr_position'],
                'license_no' => $input['license_no'],
                'telephone' => $input['telephone'],
                'mobile' => $input['mobile'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'email' => $input['email'],
            'email_verified_at' => null,
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'suffix' => $input['suffix'],
            'birthdate' => $input['birthdate'],
            'age' => $input['age'],
            'sex' => $input['sex'],
            'specialization' => $input['specialization'],
            'curr_position' => $input['curr_position'],
            'license_no' => $input['license_no'],
            'telephone' => $input['telephone'],
            'mobile' => $input['mobile'],
        ])->save();


        $user->sendEmailVerificationNotification();
    }

    public function updateUserAccount(){
        return null;
    }
}
