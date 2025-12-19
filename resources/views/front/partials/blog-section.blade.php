<section class="blog-section">
    <div class="blog-container">
        <div class="blog-header">
            <div class="section-title">Son Haberler ve Analizler</div>
            <a href="{{ route('blog.index') }}" class="view-all-link">
                <span>Tümünü Gör</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="blog-grid">
            @forelse($news ?? [] as $item)
                <article class="blog-card">
                    @if($item->slug)
                        <a href="{{ route('news.show', $item->slug) }}" class="blog-card-link">
                    @else
                        <a href="#" class="blog-card-link">
                    @endif
                        <div class="blog-image-wrapper">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="{{ $item->title }}" 
                                     class="blog-image"
                                     loading="lazy">
                            @else
                                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&h=600&fit=crop" 
                                     alt="{{ $item->title }}" 
                                     class="blog-image"
                                     loading="lazy">
                            @endif
                            @if($item->category)
                                <div class="blog-category">{{ $item->category->name }}</div>
                            @endif
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date">
                                    <i class="far fa-calendar"></i>
                                    {{ $item->created_at->format('d F Y') }}
                                </span>
                                <span class="blog-author">
                                    <i class="far fa-user"></i>
                                    {{ $item->author->name ?? 'Yazar' }}
                                </span>
                            </div>
                            <div class="blog-title">{{ $item->title }}</div>
                            <p class="blog-excerpt">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                            <div class="blog-footer">
                                <span class="read-more">Devamını Oku <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <article class="blog-card">
                    <a href="#" class="blog-card-link">
                        <div class="blog-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&h=600&fit=crop" 
                                 alt="Haber" 
                                 class="blog-image"
                                 loading="lazy">
                            <div class="blog-category">Haber</div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date">
                                    <i class="far fa-calendar"></i>
                                    -
                                </span>
                                <span class="blog-author">
                                    <i class="far fa-user"></i>
                                    -
                                </span>
                            </div>
                            <div class="blog-title">Henüz haber bulunmamaktadır</div>
                            <p class="blog-excerpt">Yakında haberler burada görünecek.</p>
                            <div class="blog-footer">
                                <span class="read-more">Devamını Oku <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforelse
        </div>
    </div>
</section>
