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

    // Comment Delete Form - Yorum silme onayı
    const commentDeleteForms = document.querySelectorAll('.comment-delete-form');
    commentDeleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Bu yorumu silmek istediğinize emin misiniz?')) {
                e.preventDefault();
                return false;
            }
        });
    });

    // Activity Form - Activityable Type ve ID Select Yönetimi
    // Etkinlik ekleme/düzenleme formunda tip seçildiğinde ilgili listeyi yükler
    const activityTypeSelect = document.getElementById('activityable_type');
    const activityIdSelect = document.getElementById('activityable_id');
    
    if (activityTypeSelect && activityIdSelect) {
        // Authors ve Categories verilerini data attribute'dan al
        const authorsData = activityTypeSelect.getAttribute('data-authors');
        const categoriesData = activityTypeSelect.getAttribute('data-categories');
        const preselectedId = activityTypeSelect.getAttribute('data-preselected-id');
        const currentId = activityTypeSelect.getAttribute('data-current-id');
        
        let authors = [];
        let categories = [];
        
        if (authorsData) {
            try {
                // HTML entity decode yap (Blade'den gelen JSON'u parse et)
                const decoded = authorsData.replace(/&quot;/g, '"');
                authors = JSON.parse(decoded);
            } catch (e) {
                console.error('Authors data parse error:', e);
            }
        }
        
        if (categoriesData) {
            try {
                // HTML entity decode yap (Blade'den gelen JSON'u parse et)
                const decoded = categoriesData.replace(/&quot;/g, '"');
                categories = JSON.parse(decoded);
            } catch (e) {
                console.error('Categories data parse error:', e);
            }
        }
        
        // Activityable type değiştiğinde ilgili listeyi yükle
        activityTypeSelect.addEventListener('change', function() {
            const type = this.value;
            
            // Select'i temizle ve disabled'ı kaldır
            activityIdSelect.innerHTML = '<option value="">Seçiniz...</option>';
            activityIdSelect.disabled = false;
            activityIdSelect.required = true;
            
            if (type === 'App\\Models\\Author' || type === 'App\Models\Author') {
                authors.forEach(function(author) {
                    const option = document.createElement('option');
                    option.value = author.id;
                    option.textContent = author.name;
                    if (currentId && author.id == currentId) {
                        option.selected = true;
                    }
                    activityIdSelect.appendChild(option);
                });
            } else if (type === 'App\\Models\\Category' || type === 'App\Models\Category') {
                categories.forEach(function(category) {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    if (currentId && category.id == currentId) {
                        option.selected = true;
                    }
                    activityIdSelect.appendChild(option);
                });
            } else {
                // Tip seçilmediyse disabled yap
                activityIdSelect.disabled = true;
                activityIdSelect.required = false;
            }
        });
        
        // Sayfa yüklendiğinde mevcut değerleri yükle
        const currentType = activityTypeSelect.value;
        if (currentType) {
            activityTypeSelect.dispatchEvent(new Event('change'));
            const idToSelect = preselectedId || currentId;
            if (idToSelect && idToSelect !== 'null' && idToSelect !== '') {
                setTimeout(function() {
                    activityIdSelect.value = idToSelect;
                }, 100);
            }
        } else {
            // Tip seçilmemişse disabled yap
            activityIdSelect.disabled = true;
            activityIdSelect.required = false;
        }
    }

    // Genel Drag and Drop Sistemi - Tüm draggable-tbody class'ına sahip tablolara uygulanır
    // Sadece draggable-tbody class'ına sahip tbody elementlerine drag and drop özelliği ekler
    const draggableTbodies = document.querySelectorAll('.draggable-tbody');
    
    draggableTbodies.forEach(function(tbody) {
        let draggedRow = null;

        // Tüm draggable satırlara event listener ekle
        const draggableRows = tbody.querySelectorAll('.draggable-row');
        
        draggableRows.forEach(function(row) {
            // Drag başladığında
            row.addEventListener('dragstart', function(e) {
                draggedRow = this;
                this.classList.add('dragging');
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/html', this.innerHTML);
            });

            // Drag bittiğinde
            row.addEventListener('dragend', function(e) {
                this.classList.remove('dragging');
                // Tüm satırlardan drag-over class'ını kaldır
                const allRows = tbody.querySelectorAll('.draggable-row');
                allRows.forEach(function(r) {
                    r.classList.remove('drag-over');
                });
            });

            // Üzerine geldiğinde
            row.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                
                // Eğer farklı bir satırın üzerindeyse
                if (this !== draggedRow) {
                    this.classList.add('drag-over');
                }
            });

            // Üzerinden ayrıldığında
            row.addEventListener('dragleave', function(e) {
                this.classList.remove('drag-over');
            });

            // Bırakıldığında
            row.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                
                if (draggedRow && this !== draggedRow) {
                    // Satırları yer değiştir
                    const rows = Array.from(tbody.querySelectorAll('.draggable-row'));
                    const draggedRowActualIndex = rows.indexOf(draggedRow);
                    const dropRowActualIndex = rows.indexOf(this);
                    
                    // Satırları DOM'da yer değiştir
                    if (draggedRowActualIndex < dropRowActualIndex) {
                        // Aşağı doğru taşı
                        tbody.insertBefore(draggedRow, this.nextSibling);
                    } else {
                        // Yukarı doğru taşı
                        tbody.insertBefore(draggedRow, this);
                    }
                    
                    // Sıralamayı güncelle
                    updateOrder(tbody);
                }
            });
        });

        // Sıralamayı backend'e gönder - Genel fonksiyon
        function updateOrder(tbodyElement) {
            const rows = tbodyElement.querySelectorAll('.draggable-row');
            const itemIds = Array.from(rows).map(function(row) {
                return parseInt(row.getAttribute('data-id'));
            });

            // CSRF token ve route URL'ini tbody elementinin data attribute'larından al
            const updateOrderUrl = tbodyElement.getAttribute('data-update-order-url');
            const csrfToken = tbodyElement.getAttribute('data-csrf-token');

            if (!updateOrderUrl) {
                console.error('Update order URL bulunamadı. Tbody elementinde data-update-order-url attribute\'u olmalı.');
                return;
            }

            if (!csrfToken) {
                console.error('CSRF token bulunamadı. Tbody elementinde data-csrf-token attribute\'u olmalı.');
                return;
            }

            // AJAX isteği gönder
            fetch(updateOrderUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    activity_ids: itemIds
                })
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    // Sıra numaralarını güncelle (görsel geri bildirim için)
                    // Sıra sütunu genellikle sondan ikinci sütundur
                    rows.forEach(function(row, index) {
                        const orderCell = row.querySelector('td:nth-last-child(2)'); // Sıra sütunu
                        if (orderCell && !isNaN(parseInt(orderCell.textContent.trim()))) {
                            // Eğer sıra sütunu sayısal bir değer içeriyorsa güncelle
                            orderCell.textContent = index + 1;
                        }
                    });
                    
                    // Başarı mesajı göster (isteğe bağlı)
                    console.log('Sıralama başarıyla güncellendi');
                } else {
                    console.error('Sıralama güncellenirken hata oluştu:', data.message || 'Bilinmeyen hata');
                }
            })
            .catch(function(error) {
                console.error('Hata:', error);
                alert('Sıralama güncellenirken bir hata oluştu. Lütfen sayfayı yenileyin.');
            });
        }
    });
});
