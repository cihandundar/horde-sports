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
        <div class="visual-section-item">
            @if($activity->image)
                <div class="visual-section-image-wrapper">
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="visual-section-image">
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
