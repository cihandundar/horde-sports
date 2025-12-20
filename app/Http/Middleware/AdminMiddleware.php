<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Admin paneli erişim kontrolü yapan middleware
     * Giriş yapmış tüm kullanıcıların admin paneline erişmesine izin verir
     * Admin işlemleri için controller seviyesinde kontrol yapılır
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kullanıcı giriş yapmış mı kontrol et
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Panele erişmek için giriş yapmalısınız.');
        }

        // Giriş yapmış tüm kullanıcılar panele erişebilir
        return $next($request);
    }
}
