<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth' => ['required', 'after:1945-01-01'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'vaccine' => ['required', 'after:2020-01-01'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {

            if($input['vaccine'] !== 'null' && !empty($input['vaccine'])) {
                if(App::isLocale('ru')) {
                    $input['vaccine'] = Carbon::createFromFormat('d-m-Y', $input['vaccine'])->format('Y-m-d'); // ДД.ММ.ГГГГ
                } else {
                    $input['vaccine'] = Carbon::createFromFormat('m-d-Y', $input['vaccine'])->format('Y-m-d'); // ММ.ДД.ГГГГ
                };
            }

            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'vaccine' => $input['vaccine'],
                'last_name' => $input['last_name'],
                'birth' => $input['birth'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'vaccine' => $input['vaccine'],
            'last_name' => $input['last_name'],
            'birth' => $input['birth'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
