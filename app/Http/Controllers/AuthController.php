<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Kullanıcı kayıt işlemi
     */
    public function register(Request $request)
    {
        // Form validasyonu
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

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
    public function login(Request $request)
    {
        // Form validasyonu
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // "Beni hatırla" checkbox kontrolü
        $remember = $request->has('remember');

        // Giriş denemesi
        if (Auth::attempt($credentials, $remember)) {
            // Session yenileme (güvenlik için)
            $request->session()->regenerate();

            // Ana sayfaya yönlendir
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
