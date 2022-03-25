<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Carbon\Carbon;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $input['birth'] = Carbon::createFromFormat($input['format'], $input['birth'])->timestamp;
        $input['vaccine'] = Carbon::createFromFormat($input['format'], $input['vaccine'])->timestamp;

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth' => ['required', 'after:1945-01-01'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'vaccine' => ['required', 'after:2020-01-01'],
            'role_id' => ['required', 'string', 'max:1'],
            'gender_id' => ['required', 'string', 'max:1'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'birth' => $input['birth'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'vaccine' => $input['vaccine'],
            'gender_id' => $input['gender_id'],
            'role_id' => $input['role_id'],
            'past_paymant' => date("Y-m-d H:i:s"), /* Edit */
            'password' => Hash::make($input['password']),
        ]);
    }
}
