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
    
    // Sidebar başlangıç durumunu ayarla
    function initSidebarState() {
        if (window.innerWidth >= 992) {
            // Desktop (992px+): Sidebar her zaman görünür
            menuSidebar.classList.remove('active');
            if (sidebarOverlay) {
                sidebarOverlay.classList.remove('active');
            }
        } else {
            // Mobil (991px-): Sidebar gizli
            menuSidebar.classList.remove('active');
            if (sidebarOverlay) {
                sidebarOverlay.classList.remove('active');
            }
        }
    }
    
    // İlk yüklemede sidebar durumunu ayarla
    initSidebarState();
    
    if (sidebarToggle && menuSidebar) {
        // Toggle butonuna tıklandığında sidebar'ı aç/kapat (sadece mobilde çalışır)
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Sadece mobilde çalış
            if (window.innerWidth < 992) {
                menuSidebar.classList.toggle('active');
                
                // Sidebar açılıyorsa overlay göster, kapanıyorsa gizle
                if (sidebarOverlay) {
                    if (menuSidebar.classList.contains('active')) {
                        sidebarOverlay.classList.add('active');
                    } else {
                        sidebarOverlay.classList.remove('active');
                    }
                }
            }
        });
        
        // Overlay'e tıklandığında sidebar'ı kapat (sadece mobilde)
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    menuSidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        }
        
        // Sidebar dışına tıklandığında sidebar'ı kapat (sadece mobilde ve açıkken)
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992 && menuSidebar.classList.contains('active')) {
                if (!menuSidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    menuSidebar.classList.remove('active');
                    if (sidebarOverlay) {
                        sidebarOverlay.classList.remove('active');
                    }
                }
            }
        });
        
        // Window resize'da desktop/mobil geçişi kontrol et
        function handleResize() {
            if (window.innerWidth >= 992) {
                // Desktop'a geçildiğinde sidebar'ı açık yap
                menuSidebar.classList.remove('active');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('active');
                }
            } else {
                // Mobil'e geçildiğinde sidebar'ı kapalı yap
                menuSidebar.classList.remove('active');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('active');
                }
            }
        }
        
        window.addEventListener('resize', handleResize);
    }
});
