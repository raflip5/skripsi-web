<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function onLogin(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            flash()->error('Invalid username or password');

            return redirect()->back();
        }

        Auth::login($user);

        flash()->success('Welcome ' . $user->username);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function register(): View
    {
        return view('auth.register');
    }
    public function ganti(): View
    {
        return view('auth.ganti');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        flash()->success('Berhasil logout account');

        return redirect()->route('login');
    }
}
