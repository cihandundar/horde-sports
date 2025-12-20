<!-- Yorumlar Bölümü -->
<section class="comments-section">
    <div class="section-title">
        <i class="fas fa-comments"></i>
        Yorumlar ({{ $comments->count() }})
    </div>

    <!-- Yorum Listesi -->
    <div class="comments-list">
        @forelse($comments as $comment)
        <div class="comment-item">
            <div class="comment-header">
                <div class="comment-author">
                    <div class="comment-author-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="comment-author-info">
                        <span class="comment-author-name">{{ $comment->author_name }}</span>
                        <span class="comment-date">
                            <i class="fas fa-calendar"></i>
                            {{ $comment->created_at->format('d.m.Y H:i') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="comment-content">
                {{ $comment->content }}
            </div>
        </div>
        @empty
        <div class="empty-comments">
            <i class="fas fa-comment-slash"></i>
            <p>Henüz yorum yapılmamış. İlk yorumu siz yapın!</p>
        </div>
        @endforelse
    </div>

    <!-- Yorum Formu -->
    <div class="comment-form-wrapper">
        <div class="comment-form-title">
            <i class="fas fa-edit"></i>
            Yorum Yap
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form class="comment-form" method="POST" action="{{ route('comment.store') }}">
            @csrf
            <input type="hidden" name="news_id" value="{{ $news->id }}">

            @guest
            <div class="form-row">
                <div class="form-group">
                    <label for="comment_name" class="form-label">
                        <i class="fas fa-user"></i>
                        Ad Soyad
                    </label>
                    <input 
                        type="text" 
                        id="comment_name" 
                        name="name" 
                        class="form-input" 
                        placeholder="Adınız ve soyadınız"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="comment_email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        E-posta
                    </label>
                    <input 
                        type="email" 
                        id="comment_email" 
                        name="email" 
                        class="form-input" 
                        placeholder="ornek@email.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @endguest

            <div class="form-group">
                <label for="comment_content" class="form-label">
                    <i class="fas fa-comment"></i>
                    Yorumunuz
                </label>
                <textarea 
                    id="comment_content" 
                    name="content" 
                    class="form-textarea" 
                    rows="5"
                    placeholder="Yorumunuzu buraya yazın..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="comment-submit-btn">
                <i class="fas fa-paper-plane"></i>
                Yorumu Gönder
            </button>
        </form>
    </div>
</section>
