<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {

        // Cek jika pengguna sudah login
        if (Auth::check()) {
            // Redirect ke dashboard jika sudah login
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Cek apakah level user adalah admin atau user biasa
        if (Auth::user()->level === 'admin') {
            return redirect()->intended('/dashboard'); // Redirect ke dashboard untuk admin
        } else {
            return redirect()->intended('/halamanguide'); // Redirect ke halguide untuk user biasa
        }
    }

    return back()->withErrors([
        'email' => 'username and password not match, try again',
    ]);
}


    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         // Cek apakah level user adalah admin atau user biasa
    //         if (Auth::user()->level === 'admin') {
    //             return redirect()->intended('/dashboard'); // Redirect ke dashboard untuk admin
    //         } else {
    //             return redirect()->intended('/halguide'); // Redirect ke halguide untuk user biasa
    //         }
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }


    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }

    public function logout()
    {
        Auth::logout(); // Hapus otentikasi

        // Tidak perlu invalidate session jika tidak pakai session
        return redirect('/login');
    }
}
