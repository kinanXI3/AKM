<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin')->with('success', 'Login successful!');
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
