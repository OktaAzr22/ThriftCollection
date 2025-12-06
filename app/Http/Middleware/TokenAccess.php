<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenAccess
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('auth_token');

        // Tidak ada token → tampilkan 403
        if (!$token) {
            abort(403, 'Akses ditolak. Token tidak ditemukan.');
        }

        // Token ada tapi bukan "1" → redirect guest
        if ($token != 67) {
            return redirect()->route('guest.index')
                             ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
