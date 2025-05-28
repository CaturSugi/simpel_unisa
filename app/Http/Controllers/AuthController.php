<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function loginView()
    {
        // if (Auth::check()) {
        //     return back();
        // }
        return view('layouts.pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->input('email');
        $key = 'login_attempts_' . $email;
        $lockoutKey = 'login_lockout_' . $email;

        // Cek apakah user sedang dalam masa lockout
        if (cache()->has($lockoutKey)) {
            $seconds = cache()->get($lockoutKey) - time();
            return back()->withErrors([
                'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . max(1, $seconds) . ' detik.',
            ])->onlyInput('email');
        }

        $attempts = cache()->get($key, 0);

        if ($attempts >= 2) {
            // Set lockout selama 1 menit
            cache()->put($lockoutKey, time() + 60, 60);
            cache()->forget($key);
            return back()->withErrors([
                'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam 60 detik.',
            ])->onlyInput('email', 'password');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            cache()->forget($key);
            cache()->forget($lockoutKey);
            return redirect()->intended('/dashboard');
        }

        $attempts++;
        cache()->put($key, $attempts, now()->addMinute());

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email', 'password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/login');
    }

    public function registerView ()
    {
        return view('layouts.pages.auth.register');
    }

    public function register (Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);
 
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
 
        Auth::login($user);
 
        return redirect('/login');
    }

    public function forgotPasswordView ()
    {
        return view('layouts.pages.auth.forgot_password');
    }

    public function forgotPassword (Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
 
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordView ($token)
    {
        return view('layouts.pages.auth.reset_password', ['token' => $token]);
    }

    public function resetPassword (Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);
 
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password)
                ])->save();
            }
        );
 
        return $status == Password::PASSWORD_RESET
                    ? redirect('/login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
