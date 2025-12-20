<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Yorum listesi
     */
    public function index(Request $request)
    {
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
     */
    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Yorum onaylandı.');
    }

    /**
     * Yorumu reddet/onayını kaldır
     */
    public function reject(Comment $comment)
    {
        $comment->update(['is_approved' => false]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Yorum onayı kaldırıldı.');
    }

    /**
     * Yorumu sil
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'Yorum başarıyla silindi.');
    }
}
