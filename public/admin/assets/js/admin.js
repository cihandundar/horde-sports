// Admin Panel JavaScript - Rules.md'ye uygun olarak oluşturuldu

// Quill Rich Text Editor Başlatma
// Sayfa yüklendiğinde content ve bio textarea'larını Quill editor'e çevirir
document.addEventListener('DOMContentLoaded', function() {
    // İçerik editörü (News için)
    const contentEditorDiv = document.getElementById('content-editor');
    const contentTextarea = document.getElementById('content');
    
    if (contentEditorDiv && contentTextarea) {
        // Quill editor oluştur
        const quillContent = new Quill('#content-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'İçerik yazın...'
        });

        // Eğer textarea'da mevcut içerik varsa (edit sayfası için), editor'e yükle
        if (contentTextarea.value) {
            quillContent.root.innerHTML = contentTextarea.value;
        }

        // Form gönderilmeden önce Quill içeriğini textarea'ya aktar
        const form = contentTextarea.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Quill'in HTML içeriğini al
                const quillHtmlContent = quillContent.root.innerHTML;
                
                // Eğer içerik boşsa (sadece <p><br></p> veya boş), boş string yaz
                const cleanContent = quillHtmlContent.trim();
                if (cleanContent === '' || cleanContent === '<p><br></p>' || cleanContent === '<p></p>') {
                    contentTextarea.value = '';
                    // İçerik boşsa form submit'ini durdur ve hata göster
                    e.preventDefault();
                    alert('İçerik alanı boş bırakılamaz. Lütfen içerik girin.');
                    return false;
                }
                
                // İçeriği textarea'ya yaz
                contentTextarea.value = quillHtmlContent;
            });
        }
    }

    // Biyografi editörü (Author için)
    const bioEditorDiv = document.getElementById('bio-editor');
    const bioTextarea = document.getElementById('bio');
    
    if (bioEditorDiv && bioTextarea) {
        // Quill editor oluştur
        const quillBio = new Quill('#bio-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            },
            placeholder: 'Biyografi yazın...'
        });

        // Eğer textarea'da mevcut içerik varsa (edit sayfası için), editor'e yükle
        if (bioTextarea.value) {
            quillBio.root.innerHTML = bioTextarea.value;
        }

        // Form gönderilmeden önce Quill içeriğini textarea'ya aktar
        const form = bioTextarea.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Quill'in HTML içeriğini textarea'ya yaz
                bioTextarea.value = quillBio.root.innerHTML;
            });
        }
    }
    
    // Admin Sidebar Toggle - Hamburger Menü İşlevselliği
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const menuSidebar = document.querySelector('.menu-sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    
    // Sidebar başlangıç durumunu ayarla (desktop'ta açık, mobilde kapalı)
    function initSidebarState() {
        if (window.innerWidth >= 1024) {
            // Desktop: Varsayılan olarak açık (active class'ı eklenmez, CSS'te zaten açık)
            menuSidebar.classList.remove('active', 'collapsed');
        } else {
            // Mobil: Varsayılan olarak kapalı (sadece ikonlar - collapsed)
            menuSidebar.classList.add('collapsed');
            menuSidebar.classList.remove('active');
        }
    }
    
    // İlk yüklemede sidebar durumunu ayarla
    initSidebarState();
    
    if (sidebarToggle && menuSidebar) {
        // Hamburger butonuna tıklandığında sidebar'ı aç/kapat
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            menuSidebar.classList.toggle('active');
            menuSidebar.classList.remove('collapsed');
            
            // Overlay'i aç/kapat (mobilde)
            if (sidebarOverlay && window.innerWidth < 1024) {
                if (menuSidebar.classList.contains('active')) {
                    sidebarOverlay.classList.add('active');
                } else {
                    sidebarOverlay.classList.remove('active');
                    menuSidebar.classList.add('collapsed');
                }
            }
        });
        
        // Overlay'e tıklandığında sidebar'ı kapat (mobilde)
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                menuSidebar.classList.remove('active');
                menuSidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            });
        }
        
        // Window resize'da desktop/mobil geçişi kontrol et
        function handleResize() {
            if (window.innerWidth >= 1024) {
                // Desktop'a geçildiğinde
                menuSidebar.classList.remove('active', 'collapsed');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('active');
                }
            } else {
                // Mobil'e geçildiğinde
                if (!menuSidebar.classList.contains('active')) {
                    menuSidebar.classList.add('collapsed');
                }
            }
        }
        
        window.addEventListener('resize', handleResize);
    }
});
