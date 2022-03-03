<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class SocialController extends Controller
{
    public function facebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function LoginWithFacebook() {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('facebook_id', $user->id)->first();
            if ($isUser) {
                Auth::login($isUser);
                return redirect('/');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => Carbon::tomorrow(),
                    'facebook_id' => $user->id,
                    'phone' =>  Hash::make($user->email),
                    'gender_id' => '1',
                    'role_id' => '2',
                    'password' => Hash::make('password'),
                ]);
                Auth::login($createUser);
                return redirect('/');
            };
        } catch(Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function LoginWithGoogle() {
        try {
            $user = Socialite::driver('google')->user();
            $isUser = User::where('google_id', $user->id)->first();
            if ($isUser) {
                Auth::login($isUser);
                return redirect('/');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => Carbon::tomorrow(),
                    'google_id' => $user->id,
                    'phone' =>  Hash::make($user->email),
                    'gender_id' => '1',
                    'role_id' => '2',
                    'password' => Hash::make('password'),
                ]);
                Auth::login($createUser);
                return redirect('/');
            };
        } catch(Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
