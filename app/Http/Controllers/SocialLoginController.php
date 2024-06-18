<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)
            ->redirect();
    }
    public function callback($provider)
    {

        try {
            $user = Socialite::driver($provider)->user();
            $provider_user = User::where([
                'provider_name' => $provider,
                'provider_id' => $user->provider_id
            ])->first();
            if (!$provider_user) {
                $provider_user = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Crypt::encrypt(Str::random(8)),
                    'provider_name' => $provider,
                    'provider_id' => $user->getId(),
                    'provider_token' => $user->token,
                ]);
            }

            Auth::login($provider_user);

            return redirect('/');
        } catch (Throwable $e) {
            return redirect()->route('register')->withErrors([
                'email' => $e->getMessage()
            ]);
        }
    }
}
