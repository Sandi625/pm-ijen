<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        // Regenerate session setelah login agar hindari session fixation
        $request->session()->regenerate();

        $level = Auth::user()->level;

        if ($level === 'admin') {
            return redirect()->intended('/dashboard');
        } elseif ($level === 'guide') {
            return redirect()->intended('/halamanguide');
        } elseif ($level === 'pelanggan') {
            return redirect()->intended('/customer/packages');
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['email' => 'Level user tidak valid.']);
        }
    }

    return back()->withErrors(['email' => 'Email dan password tidak cocok, coba lagi.']);
}






   public function logout(Request $request)
{
    Auth::logout();

    // Invalidate session yang lama biar benar-benar bersih
    $request->session()->invalidate();

    // Regenerate token CSRF agar fresh session
    $request->session()->regenerateToken();

    return redirect('/login');
}


}
