// Arama Açma/Kapama İşlevi
document.addEventListener('DOMContentLoaded', function() {
    const searchToggle = document.querySelector('.search-toggle');
    const searchContainer = document.querySelector('.header-search');
    const searchOverlay = document.querySelector('.search-overlay');
    const searchInput = document.querySelector('.search-input');
    const searchClose = document.querySelector('.search-close');

    if (searchToggle && searchContainer && searchOverlay) {
        // Arama ikonuna tıklanınca arama overlay'ini aç
        searchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            searchContainer.classList.add('active');
            // Input'a focus ver
            setTimeout(function() {
                if (searchInput) {
                    searchInput.focus();
                }
            }, 100);
        });

        // Kapat butonuna tıklanınca arama overlay'ini kapat
        if (searchClose) {
            searchClose.addEventListener('click', function() {
                searchContainer.classList.remove('active');
            });
        }

        // Overlay'e tıklanınca (ama panel'e değil) arama overlay'ini kapat
        searchOverlay.addEventListener('click', function(e) {
            const searchPanel = document.querySelector('.search-panel');
            if (e.target === searchOverlay && !searchPanel.contains(e.target)) {
                searchContainer.classList.remove('active');
            }
        });

        // ESC tuşuna basınca arama overlay'ini kapat
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchContainer.classList.contains('active')) {
                searchContainer.classList.remove('active');
            }
        });

        // Form submit edildiğinde arama işlemi
        const searchForm = document.querySelector('.search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const searchValue = searchInput.value.trim();
                // Eğer arama değeri boşsa form submit edilmesin
                if (searchValue === '') {
                    e.preventDefault();
                    return false;
                }
                // Form submit edilecek, normal form davranışı devam edecek
            });
        }
    }
});

// User Dropdown Açma/Kapama İşlevi
document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggle = document.querySelector('.user-dropdown-toggle');
    const dropdownMenu = document.querySelector('.user-dropdown-menu');
    const dropdownContainer = document.querySelector('.header-user-dropdown');

    if (dropdownToggle && dropdownMenu && dropdownContainer) {
        // Dropdown toggle butonuna tıklama
        dropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownContainer.classList.toggle('active');
        });

        // Dışarı tıklandığında dropdown'ı kapat
        document.addEventListener('click', function(e) {
            if (!dropdownContainer.contains(e.target)) {
                dropdownContainer.classList.remove('active');
            }
        });

        // Dropdown içindeki linklere tıklandığında dropdown'ı kapat
        const dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(function(item) {
            item.addEventListener('click', function() {
                dropdownContainer.classList.remove('active');
            });
        });
    }
});

// Mobile Menu Toggle İşlevi
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const headerNav = document.querySelector('.header-nav');

    if (mobileMenuToggle && headerNav) {
        mobileMenuToggle.addEventListener('click', function() {
            headerNav.classList.toggle('active');
        });

        // Menü dışına tıklandığında menüyü kapat
        document.addEventListener('click', function(e) {
            if (!headerNav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                headerNav.classList.remove('active');
            }
        });

        // Menü linklerine tıklandığında menüyü kapat
        const menuLinks = headerNav.querySelectorAll('.menu-link');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                headerNav.classList.remove('active');
            });
        });
    }
});

// Maçlar ve Skorlar Slider İşlevi (Swiper.js)
document.addEventListener('DOMContentLoaded', function() {
    const matchesSwiper = document.querySelector('.matches-swiper');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    
    if (matchesSwiper && prevBtn && nextBtn) {
        const swiper = new Swiper('.matches-swiper', {
            slidesPerView: 4,
            spaceBetween: 16,
            loop: true,
            loopedSlides: 5,
            speed: 500,
            navigation: {
                nextEl: '.slider-next',
                prevEl: '.slider-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 12,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 16,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 16,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 16,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 16,
                },
            },
        });
    }
});

