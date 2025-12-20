<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Yeni yorum ekle
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        
        // Kullanıcı giriş yapmışsa user_id'yi ekle
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
            // Giriş yapmış kullanıcılar için name ve email gerekli değil
            unset($validated['name'], $validated['email']);
        }

        // Yeni yorumlar varsayılan olarak onay bekliyor (is_approved = false)
        $validated['is_approved'] = false;

        Comment::create($validated);

        return back()->with('success', 'Yorumunuz gönderildi. Onaylandıktan sonra yayınlanacaktır.');
    }
}
