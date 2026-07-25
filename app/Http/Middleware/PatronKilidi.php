<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PatronKilidi
{
    public function handle(Request $request, Closure $next)
    {
        // Session'da admin giriş yapmış mı kontrol et
        if (!session('admin_logged_in')) {
            // Yapmamışsa gizli şifre ekranına şutla!
            return redirect('/admin/giris');
        }
        return $next($request);
    }
}