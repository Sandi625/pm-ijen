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
                $level = Auth::user()->level;

                if ($level === 'admin') {
                    return redirect()->intended('/dashboard'); // Redirect ke dashboard admin
                } elseif ($level === 'guide') {
                    return redirect()->intended('/halamanguide'); // Redirect ke halaman guide
                } elseif ($level === 'pelanggan') {
                    return redirect()->intended('/customer/packages'); // Redirect ke halaman pelanggan
                } else {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Level user tidak valid.',
                    ]);
                }
            }

            return back()->withErrors([
                'email' => 'Email dan password tidak cocok, coba lagi.',
            ]);
        }




    public function logout()
    {
        Auth::logout(); // Hapus otentikasi

        // Tidak perlu invalidate session jika tidak pakai session
        return redirect('/login');
    }
}
