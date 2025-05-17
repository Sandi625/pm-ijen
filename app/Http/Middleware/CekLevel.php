<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    public function handle($request, Closure $next, ...$levels)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // atau ke halaman login yang kamu punya
        }

        // Cek apakah level user termasuk dalam yang diijinkan
        if (!in_array(Auth::user()->level, $levels)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
