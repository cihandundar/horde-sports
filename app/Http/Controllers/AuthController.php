<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Kullanıcı kayıt işlemi
     */
    public function register(RegisterRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        // Yeni kullanıcı oluştur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Kullanıcıyı otomatik giriş yap
        Auth::login($user);

        // Ana sayfaya yönlendir
        return redirect()->route('home')->with('success', 'Kayıt işlemi başarılı! Hoş geldiniz.');
    }

    /**
     * Kullanıcı giriş işlemi
     */
    public function login(LoginRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $credentials = $request->only(['email', 'password']);

        // "Beni hatırla" checkbox kontrolü
        $remember = $request->has('remember');

        // Giriş denemesi
        if (Auth::attempt($credentials, $remember)) {
            // Session yenileme (güvenlik için)
            $request->session()->regenerate();

            // Admin ise dashboard'a, değilse ana sayfaya yönlendir
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Admin paneline hoş geldiniz!');
            }

            // Normal kullanıcıları ana sayfaya yönlendir
            return redirect()->route('home')->with('success', 'Giriş başarılı! Hoş geldiniz.');
        }

        // Giriş başarısız ise hata mesajı ile geri dön
        return back()->withErrors([
            'email' => 'E-posta adresi veya şifre hatalı.',
        ])->onlyInput('email');
    }

    /**
     * Kullanıcı çıkış işlemi
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Çıkış yapıldı.');
    }
}
