<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Kullanıcılar listesi sayfasını göster
     */
    public function index()
    {
        $users = User::latest()->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Kullanıcıyı admin yap
     */
    public function makeAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı admin yapıldı.');
    }

    /**
     * Kullanıcıyı normal kullanıcı yap
     */
    public function removeAdmin(User $user)
    {
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
     */
    public function destroy(User $user)
    {
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
