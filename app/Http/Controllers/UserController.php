<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function UserLogin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->letters()],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user && $user->role == 'Manager') {
                return redirect()->intended('/dashboard-manager')->with('success', 'Login Sebagai Manager');
            }
            if ($user->role == 'Director') {
                return redirect()->intended('/dashboard-director')->with('success', 'Login Sebagai Director');
            }
            return redirect()->intended('/dashboard-finance')->with('success', 'Login Sebagai Finance');
        }

        return redirect()
            ->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Berhasil.');
    }
}
