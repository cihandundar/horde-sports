<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Admin kontrolü yapan middleware
     * Sadece admin rolüne sahip kullanıcıların admin paneline erişmesine izin verir
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kullanıcı giriş yapmış mı kontrol et
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Admin paneline erişmek için giriş yapmalısınız.');
        }

        // Kullanıcı admin mi kontrol et
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Bu sayfaya erişim yetkiniz yok.');
        }

        return $next($request);
    }
}
