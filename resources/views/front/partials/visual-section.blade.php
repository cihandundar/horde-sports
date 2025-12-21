{{-- 
    Reusable Visual Section Partial
    Herhangi bir sayfada görsel bölüm oluşturmak için kullanılabilir
    
    KULLANIM ÖRNEKLERİ:
    
    1. Yazar Etkinlikleri:
    @include('front.partials.visual-section', [
        'title' => 'Katıldığı Etkinlikler',
        'activities' => $author->activities,
        'emptyMessage' => 'Henüz etkinlik bulunmamaktadır.'
    ])
    
    2. Kategori Etkinlikleri:
    @include('front.partials.visual-section', [
        'title' => 'Kategori Etkinlikleri',
        'activities' => $category->activities,
        'emptyMessage' => 'Henüz etkinlik bulunmamaktadır.'
    ])
    
    3. Özel Veri (Manuel):
    @include('front.partials.visual-section', [
        'title' => 'Özel Başlık',
        'activities' => $customActivities, // Herhangi bir collection
        'emptyMessage' => 'İçerik bulunmamaktadır.'
    ])
    
    NOT: İstediğiniz sayfaya bu kodu ekleyerek görsel bölümü aktif edebilirsiniz.
    Eklemek istemezseniz, sadece bu satırı yazmayın.
--}}

{{-- 
    Visual Section - Otomatik olarak view'larda include edilir
    Manuel olarak activities verisi gönderilirse görünür, gönderilmezse hiçbir şey göstermez
--}}

@if(isset($activities) && $activities->count() > 0)
<section class="visual-section">
    @if(isset($title) && $title)
        <div class="section-title">{{ $title }}</div>
    @endif
    
    <div class="visual-section-grid">
        @foreach($activities as $activity)
        <a href="{{ route('activity.show', $activity->slug) }}" class="visual-section-item-link">
        <div class="visual-section-item">
            @if($activity->images && count($activity->images) > 0)
                {{-- Galeri gösterimi - Birden fazla resim varsa galeri olarak göster --}}
                <div class="visual-section-gallery">
                    @if(count($activity->images) === 1)
                        {{-- Tek resim varsa normal göster --}}
                        <div class="visual-section-image-wrapper">
                            <img src="{{ asset('storage/' . $activity->images[0]) }}" alt="{{ $activity->title }}" class="visual-section-image">
                        </div>
                    @else
                        {{-- Çoklu resim varsa galeri olarak göster --}}
                        <div class="visual-section-gallery-main">
                            <img src="{{ asset('storage/' . $activity->images[0]) }}" alt="{{ $activity->title }}" class="visual-section-image">
                            <div class="visual-section-gallery-count">
                                <i class="fas fa-images"></i>
                                <span>{{ count($activity->images) }}</span>
                            </div>
                        </div>
                        @if(count($activity->images) > 1)
                        <div class="visual-section-gallery-thumbnails">
                            @foreach(array_slice($activity->images, 1, 4) as $image)
                            <div class="visual-section-gallery-thumb">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $activity->title }}">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    @endif
                </div>
            @else
                <div class="visual-section-image-placeholder">
                    <i class="fas fa-image"></i>
                </div>
            @endif
            
            <div class="visual-section-content">
                <div class="visual-section-item-title">{{ $activity->title }}</div>
                @if($activity->description)
                    <p class="visual-section-item-description">{{ Str::limit(strip_tags($activity->description), 120) }}</p>
                @endif
            </div>
        </div>
        </a>
        @endforeach
    </div>
</section>
@elseif(isset($activities) && isset($emptyMessage) && $emptyMessage)
    {{-- Sadece activities set edilmişse ve boşsa empty message göster --}}
    <div class="empty-state">
        <p>{{ $emptyMessage }}</p>
    </div>
@endif
{{-- activities set edilmemişse hiçbir şey gösterme --}}
