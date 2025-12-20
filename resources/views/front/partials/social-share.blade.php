{{-- Sosyal Medya Paylaşım Butonları --}}
<div class="social-share">
    <div class="social-share-label">
        <i class="fas fa-share-alt"></i>
        <span>Paylaş</span>
    </div>
    <div class="social-share-buttons">
        {{-- Facebook Paylaşım --}}
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="social-share-btn social-share-facebook"
           aria-label="Facebook'ta Paylaş">
            <i class="fab fa-facebook-f"></i>
            <span>Facebook</span>
        </a>
        
        {{-- Twitter Paylaşım --}}
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="social-share-btn social-share-twitter"
           aria-label="Twitter'da Paylaş">
            <i class="fab fa-twitter"></i>
            <span>Twitter</span>
        </a>
        
        {{-- LinkedIn Paylaşım --}}
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($news->title) }}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="social-share-btn social-share-linkedin"
           aria-label="LinkedIn'de Paylaş">
            <i class="fab fa-linkedin-in"></i>
            <span>LinkedIn</span>
        </a>
        
        {{-- WhatsApp Paylaşım --}}
        <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . url()->current()) }}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="social-share-btn social-share-whatsapp"
           aria-label="WhatsApp'ta Paylaş">
            <i class="fab fa-whatsapp"></i>
            <span>WhatsApp</span>
        </a>
        
        {{-- Kopyala Butonu --}}
        <button type="button" 
                class="social-share-btn social-share-copy"
                data-url="{{ url()->current() }}"
                aria-label="Linki Kopyala">
            <i class="fas fa-link"></i>
            <span>Kopyala</span>
        </button>
    </div>
</div>
