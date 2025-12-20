<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Kullanıcılar listesi sayfasını göster
     * Sadece admin kullanıcılar erişebilir
     */
    public function index()
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu sayfaya erişim yetkiniz yok.');
        }

        $users = User::latest()->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Kullanıcıyı admin yap
     * Sadece admin kullanıcılar erişebilir
     */
    public function makeAdmin(User $user)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $user->update(['role' => 'admin']);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı admin yapıldı.');
    }

    /**
     * Kullanıcıyı normal kullanıcı yap
     * Sadece admin kullanıcılar erişebilir
     */
    public function removeAdmin(User $user)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        // Kendini admin'den çıkaramaz
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Kendi admin yetkinizi kaldıramazsınız.');
        }
        
        $user->update(['role' => 'user']);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcının admin yetkisi kaldırıldı.');
    }

    /**
     * Kullanıcıyı sil
     * Sadece admin kullanıcılar erişebilir
     */
    public function destroy(User $user)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        // Kendini silemez
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Kendinizi silemezsiniz.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı silindi.');
    }
}
