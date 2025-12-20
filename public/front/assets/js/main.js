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
                
                // Arama değeri boşsa veya çok kısa ise
                if (searchValue === '') {
                    e.preventDefault();
                    showSearchError('Lütfen arama terimi girin');
                    return false;
                }
                
                if (searchValue.length < 2) {
                    e.preventDefault();
                    showSearchError('Arama terimi en az 2 karakter olmalıdır');
                    return false;
                }
                
                // Hataları temizle
                clearSearchError();
            });
            
            // Real-time validation
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const value = this.value.trim();
                    if (value.length > 0 && value.length < 2) {
                        showSearchError('Arama terimi en az 2 karakter olmalıdır');
                    } else {
                        clearSearchError();
                    }
                });
            }
        }
        
        // Arama hatası göster
        function showSearchError(message) {
            clearSearchError();
            const errorDiv = document.createElement('div');
            errorDiv.className = 'search-error';
            errorDiv.style.cssText = 'color: #dc3545; font-size: 14px; margin-top: 12px; padding: 10px 16px; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; text-align: center;';
            errorDiv.textContent = message;
            
            const searchForm = document.querySelector('.search-form');
            if (searchForm) {
                searchForm.parentNode.insertBefore(errorDiv, searchForm.nextSibling);
            }
        }
        
        // Arama hatasını temizle
        function clearSearchError() {
            const errorDiv = document.querySelector('.search-error');
            if (errorDiv) {
                errorDiv.remove();
            }
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

        // Logout butonlarına tıklandığında dropdown'ı kapat
        const logoutForms = dropdownMenu.querySelectorAll('.dropdown-logout-form');
        logoutForms.forEach(function(form) {
            form.addEventListener('submit', function() {
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

// Form Validation Functions
document.addEventListener('DOMContentLoaded', function() {
    // Email format validation helper
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Show error message
    function showFieldError(input, message) {
        // Remove existing error
        clearFieldError(input);
        
        // Add error class to input
        input.classList.add('is-invalid');
        
        // Create error element
        const errorDiv = document.createElement('span');
        errorDiv.className = 'form-error';
        errorDiv.textContent = message;
        
        // Insert after input
        input.parentNode.appendChild(errorDiv);
    }
    
    // Clear error message
    function clearFieldError(input) {
        input.classList.remove('is-invalid');
        const errorDiv = input.parentNode.querySelector('.form-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
    
    // Login Form Validation
    const loginForm = document.querySelector('.auth-form[action*="login"]');
    if (loginForm) {
        const emailInput = loginForm.querySelector('#email');
        const passwordInput = loginForm.querySelector('#password');
        
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Email validation
            if (emailInput) {
                const emailValue = emailInput.value.trim();
                if (!emailValue) {
                    showFieldError(emailInput, 'E-posta adresi gereklidir');
                    isValid = false;
                } else if (!isValidEmail(emailValue)) {
                    showFieldError(emailInput, 'Geçerli bir e-posta adresi girin');
                    isValid = false;
                } else {
                    clearFieldError(emailInput);
                }
            }
            
            // Password validation
            if (passwordInput) {
                const passwordValue = passwordInput.value;
                if (!passwordValue) {
                    showFieldError(passwordInput, 'Şifre gereklidir');
                    isValid = false;
                } else if (passwordValue.length < 6) {
                    showFieldError(passwordInput, 'Şifre en az 6 karakter olmalıdır');
                    isValid = false;
                } else {
                    clearFieldError(passwordInput);
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
        
        // Real-time validation for email
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const value = this.value.trim();
                if (value && !isValidEmail(value)) {
                    showFieldError(this, 'Geçerli bir e-posta adresi girin');
                } else if (value) {
                    clearFieldError(this);
                }
            });
            
            emailInput.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    const value = this.value.trim();
                    if (value && isValidEmail(value)) {
                        clearFieldError(this);
                    }
                }
            });
        }
        
        // Real-time validation for password
        if (passwordInput) {
            passwordInput.addEventListener('blur', function() {
                const value = this.value;
                if (value && value.length < 6) {
                    showFieldError(this, 'Şifre en az 6 karakter olmalıdır');
                } else if (value) {
                    clearFieldError(this);
                }
            });
        }
    }
    
    // Register Form Validation
    const registerForm = document.querySelector('.auth-form[action*="register"]');
    if (registerForm) {
        const nameInput = registerForm.querySelector('#name');
        const emailInput = registerForm.querySelector('#email');
        const passwordInput = registerForm.querySelector('#password');
        const passwordConfirmInput = registerForm.querySelector('#password_confirmation');
        const termsCheckbox = registerForm.querySelector('input[name="terms"]');
        
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Name validation
            if (nameInput) {
                const nameValue = nameInput.value.trim();
                if (!nameValue) {
                    showFieldError(nameInput, 'Ad soyad gereklidir');
                    isValid = false;
                } else if (nameValue.length < 3) {
                    showFieldError(nameInput, 'Ad soyad en az 3 karakter olmalıdır');
                    isValid = false;
                } else if (!/^[a-zA-ZğüşıöçĞÜŞİÖÇ\s]+$/.test(nameValue)) {
                    showFieldError(nameInput, 'Ad soyad sadece harf ve boşluk içerebilir');
                    isValid = false;
                } else {
                    clearFieldError(nameInput);
                }
            }
            
            // Email validation
            if (emailInput) {
                const emailValue = emailInput.value.trim();
                if (!emailValue) {
                    showFieldError(emailInput, 'E-posta adresi gereklidir');
                    isValid = false;
                } else if (!isValidEmail(emailValue)) {
                    showFieldError(emailInput, 'Geçerli bir e-posta adresi girin');
                    isValid = false;
                } else {
                    clearFieldError(emailInput);
                }
            }
            
            // Password validation
            if (passwordInput) {
                const passwordValue = passwordInput.value;
                if (!passwordValue) {
                    showFieldError(passwordInput, 'Şifre gereklidir');
                    isValid = false;
                } else if (passwordValue.length < 8) {
                    showFieldError(passwordInput, 'Şifre en az 8 karakter olmalıdır');
                    isValid = false;
                } else {
                    clearFieldError(passwordInput);
                }
            }
            
            // Password confirmation validation
            if (passwordConfirmInput && passwordInput) {
                const passwordValue = passwordInput.value;
                const confirmValue = passwordConfirmInput.value;
                if (!confirmValue) {
                    showFieldError(passwordConfirmInput, 'Şifre tekrar gereklidir');
                    isValid = false;
                } else if (passwordValue !== confirmValue) {
                    showFieldError(passwordConfirmInput, 'Şifreler eşleşmiyor');
                    isValid = false;
                } else {
                    clearFieldError(passwordConfirmInput);
                }
            }
            
            // Terms checkbox validation
            if (termsCheckbox && !termsCheckbox.checked) {
                const termsLabel = termsCheckbox.closest('.checkbox-label');
                if (termsLabel) {
                    termsLabel.style.color = '#dc3545';
                    termsLabel.style.fontWeight = '600';
                    
                    // Reset after 3 seconds
                    setTimeout(function() {
                        termsLabel.style.color = '';
                        termsLabel.style.fontWeight = '';
                    }, 3000);
                }
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
        
        // Real-time validation for name
        if (nameInput) {
            nameInput.addEventListener('blur', function() {
                const value = this.value.trim();
                if (value && value.length < 3) {
                    showFieldError(this, 'Ad soyad en az 3 karakter olmalıdır');
                } else if (value && !/^[a-zA-ZğüşıöçĞÜŞİÖÇ\s]+$/.test(value)) {
                    showFieldError(this, 'Ad soyad sadece harf ve boşluk içerebilir');
                } else if (value) {
                    clearFieldError(this);
                }
            });
        }
        
        // Real-time validation for email
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const value = this.value.trim();
                if (value && !isValidEmail(value)) {
                    showFieldError(this, 'Geçerli bir e-posta adresi girin');
                } else if (value) {
                    clearFieldError(this);
                }
            });
        }
        
        // Real-time validation for password
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const value = this.value;
                if (value && value.length < 8) {
                    showFieldError(this, 'Şifre en az 8 karakter olmalıdır');
                } else if (value) {
                    clearFieldError(this);
                }
                
                // Check password confirmation if it has value
                if (passwordConfirmInput && passwordConfirmInput.value) {
                    if (value !== passwordConfirmInput.value) {
                        showFieldError(passwordConfirmInput, 'Şifreler eşleşmiyor');
                    } else {
                        clearFieldError(passwordConfirmInput);
                    }
                }
            });
        }
        
        // Real-time validation for password confirmation
        if (passwordConfirmInput && passwordInput) {
            passwordConfirmInput.addEventListener('blur', function() {
                const value = this.value;
                const passwordValue = passwordInput.value;
                if (value && value !== passwordValue) {
                    showFieldError(this, 'Şifreler eşleşmiyor');
                } else if (value) {
                    clearFieldError(this);
                }
            });
        }
    }
});

