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
});
