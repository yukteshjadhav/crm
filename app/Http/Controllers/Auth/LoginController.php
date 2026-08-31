<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show login page
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()
                ->intended('/dashboard')
                ->with('success', 'Login successful.');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out successfully.');
    }
}
