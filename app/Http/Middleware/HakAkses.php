<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HakAkses
{
    public function handle(Request $request, Closure $next)
    {
        $nama = session('nama');

        if (!$nama) {
            return redirect('/');
        }

        if ($nama !== 'okta') {
            return redirect('/guest');
        }

        return $next($request);
    }
}