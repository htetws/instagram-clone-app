<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register()
    {
        return view('Auth.register');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $g_user = Socialite::driver('google')->user();
        $user = User::where('email', $g_user->email)->first();

        if (!$user) {
            $user = new User();
            $user->name = $g_user->name;
            $user->email = $g_user->email;
            $user->password = Hash::make('kkc552001');
            $user->username = str_replace(' ', '_', Str::lower($g_user->name)) . Str::random(7) . random_int(1, 10000);
            $user->save();
        };
        Auth::login($user);
        return redirect('/');
    }
}
