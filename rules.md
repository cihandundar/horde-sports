# PROJE GELİŞTİRME KURALLARI

## ⚠️ ÖNEMLİ NOT
**HER İŞLEM ÖNCESİ BU rules.md DOSYASINI OKUYARAK HAREKET ET**

--- genelde GRİD template-column rows kullan grid-column span lara böl ÇOK SIKIŞIRSAN FLEX KULLAN YAPILARI BÖLERKEN
Görselleri unplashtan al

## 📝 HTML ETİKET KURALLARI

### Başlık Etiketleri (H1-H6)
- ✅ **Her sayfada sadece bir H1 kullan** - Sayfa başlığı için
- ❌ **H2, H3, H4, H5, H6 kullanma** - Diğer H etiketleri kullanılmayacak
- ✅ **H1 için `.title` class'ını kullan** - Ana başlık için
- ✅ **Section başlıkları için `.section-title` class'ını kullan** - Bölüm başlıkları için
- ✅ **CSS'te bir üst class'tan yakala** - Örnek: `.auth-card .title` şeklinde
- ✅ **Ayrı değişiklik yapılacaksa özel class kullan** - Örnek: `.dashboard-page .title`


## 🔴 KRİTİK KURALLAR (MUTLAKA UYULMALI)

### 1. Blade Template Yapısı
- ✅ **@yield('content') mantığını kullan** - Base blade'de mutlaka `@yield('content')` olmalı
- ✅ **Her yeni sayfa için @extends kullan** - Tüm sayfalar `@extends('front.base')` ile base'i extend etmeli
- ✅ **@section('content') ile içerik doldur** - Her sayfa `@section('content')` ile içeriğini tanımlamalı
- ✅ **Base blade oluştur** - İlk adım olarak base blade template oluşturulmalı
- ✅ **Route düzelt** - web.php'de route'lar doğru view dosyalarını göstermeli

### 2. CSS Yazım Kuralları
- ✅ **CSS root değişkenlerini kullan** - Renkler, border, shadow gibi tekrar eden değerler için CSS `:root` değişkenleri kullan
- ✅ **Tekrar eden değerleri root'a ekle** - Çok tekrar edecek CSS değerleri (renkler, border-radius, shadow, spacing vb.) mutlaka root'a eklenmeli
- ✅ **Sadece px kullan** - CSS'te rem, em, vh, vw gibi birimler kullanma, sadece **px (piksel)** kullan

### 3. Yorum Satırları
- ✅ **Tüm yorumlar Türkçe olmalı** - Uygulanan her değişiklik yorum satırlarında Türkçe olarak açıklanmalı

---

## 📋 GENEL KURALLAR

### İlk Adımlar
1. İlk olarak base blade oluştur
2. web.php'den route düzelt

### Kod Standartları
- Yorum satırlarında Türkçe açıklama yap
- Her değişikliği yorumla

---

## 🚫 KULLANILMAYACAK TEKNOLOJİLER

- ❌ React.js, Vue.js, Angular.js, Next.js gibi frontend framework'leri kullanma
- ❌ Tailwind CSS kullanma
- ❌ Vite kullanma
- ❌ Herhangi bir ek kütüphane kullanma

---

## ✅ KULLANILACAK TEKNOLOJİLER

- ✅ **İkonlar:** FontAwesome kullan (CDN üzerinden)
- ✅ **Veritabanı:** MySQL kullan
- ✅ **Template Engine:** Laravel Blade Template Engine

---

## 📁 DOSYA YAPISI VE ORGANİZASYON

### Blade Dosyalama Mantığı
- ✅ Dosyalama mantığı olarak **partials** özelliğini kullan
- ✅ Mümkün olan her yapıyı farklı bir blade dosyasına ayır ve onu include et
- ✅ Her sayfa için ayrı blade dosyası oluştur (`index.blade.php`, `about.blade.php` vb.)

### Partials Klasörü
- ✅ Header, footer gibi alanları **partials** klasörü açıp ayrı blade dosyalarına yaz
- ✅ Partials yolu: `resources/views/front/partials/`
- ✅ Örnek: `resources/views/front/partials/header.blade.php`, `resources/views/front/partials/footer.blade.php`
- ✅ Partials'ları `@include('front.partials.header')` şeklinde kullan

### CSS ve JS Dosyaları
- ❌ **Inline CSS kullanma** - Kesinlikle yasak
- ❌ **Inline JS kullanma** - Kesinlikle yasak
- ✅ CSS dosyası: `public/front/assets/css/main.css`
- ✅ JS dosyası: `public/front/assets/js/main.js`
- ✅ CSS ve JS kodları için `public/front/assets/` altındaki dosyaları kullan

---

## 🏷️ İSİMLENDİRME KURALLARI

### Blade Dosyaları
- ✅ Class ve ID isimleri **İngilizce** olmalı
- ✅ Dosya isimleri **küçük harf** ve **kebab-case** kullanılabilir (örn: `user-profile.blade.php`)

### Backend Dosyaları
- ✅ Migration, Model ve Controller dosyalarında isimlendirmeleri **İngilizce** olarak ilerlet
- ✅ Laravel naming conventions'a uy

---

## 📝 TEKRAR EDEN VE KRİTİK NOKTALAR

### ✅ Her Zaman Yapılacaklar
1. ✅ Her işlem öncesi rules.md'yi oku
2. ✅ Base blade'de `@yield('content')` kullan
3. ✅ Her sayfa `@extends('front.base')` ile extend etsin
4. ✅ Her sayfa `@section('content')` ile içerik tanımlasın
5. ✅ Partials kullan (header, footer vb.)
6. ✅ Yorumları Türkçe yaz
7. ✅ Class/ID isimleri İngilizce olsun
8. ✅ CSS root değişkenlerini kullan
9. ✅ Inline CSS/JS kullanma
10. ✅ FontAwesome ikonları kullan
11. ✅ Her sayfada sadece bir H1 kullan (`.title` class'ı ile)
12. ✅ H2-H6 etiketleri kullanma, bunun yerine `.section-title` class'ı kullan

### ❌ Asla Yapılmayacaklar
1. ❌ Frontend framework kullanma (React, Vue, Angular, Next.js)
2. ❌ Tailwind CSS kullanma
3. ❌ Vite kullanma
4. ❌ Ek kütüphane kullanma
5. ❌ Inline CSS yazma
6. ❌ Inline JS yazma
7. ❌ Türkçe class/ID isimleri kullanma
8. ❌ H2, H3, H4, H5, H6 etiketleri kullanma
9. ❌ CSS'te rem, em, vh, vw gibi birimler kullanma - Sadece px kullan

---

## 📝 ÖZET

- ✅ Laravel Blade Template Engine kullan
- ✅ FontAwesome ikonları kullan
- ✅ Partials ile modüler yapı oluştur
- ✅ CSS/JS için public/front/assets klasörünü kullan
- ✅ CSS root değişkenlerini kullan (renkler, border, shadow vb.)
- ✅ İsimlendirmeler İngilizce olsun
- ✅ Yorumlar Türkçe olsun
- ✅ MySQL veritabanı kullan
- ✅ @yield('content') ve @extends mantığını kullan