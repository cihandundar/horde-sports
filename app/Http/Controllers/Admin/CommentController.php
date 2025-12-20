<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Yorum listesi
     * Sadece admin kullanıcılar erişebilir
     */
    public function index(Request $request)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu sayfaya erişim yetkiniz yok.');
        }

        $query = Comment::with(['news', 'user'])->latest();

        // Filtreleme: Onay durumuna göre
        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $comments = $query->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Yorumu onayla
     * Sadece admin kullanıcılar erişebilir
     */
    public function approve(Comment $comment)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $comment->update(['is_approved' => true]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Yorum onaylandı.');
    }

    /**
     * Yorumu reddet/onayını kaldır
     * Sadece admin kullanıcılar erişebilir
     */
    public function reject(Comment $comment)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $comment->update(['is_approved' => false]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Yorum onayı kaldırıldı.');
    }

    /**
     * Yorumu sil
     * Sadece admin kullanıcılar erişebilir
     */
    public function destroy(Comment $comment)
    {
        // Sadece admin kullanıcılar erişebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'Yorum başarıyla silindi.');
    }
}
