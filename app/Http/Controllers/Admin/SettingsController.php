<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Ayarlar sayfasını göster
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.settings.index', compact('user'));
    }

    /**
     * Profil bilgilerini güncelle
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        $user->update($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Profil bilgileri başarıyla güncellendi.');
    }

    /**
     * Şifre değiştir
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        $user = Auth::user();

        // Mevcut şifreyi kontrol et
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifre yanlış.']);
        }

        // Yeni şifreyi güncelle
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Şifre başarıyla değiştirildi.');
    }
}
