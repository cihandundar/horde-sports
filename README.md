# Horde Sports

Spor dünyasının nabzını tutan, en güncel haberler ve analizler sunan modern bir web uygulaması.

## 📋 İçindekiler

- [Proje Hakkında](#proje-hakkında)
- [Teknolojiler](#teknolojiler)
- [Özellikler](#özellikler)
- [Gereksinimler](#gereksinimler)
- [Kurulum](#kurulum)
- [Kullanım](#kullanım)
- [Proje Yapısı](#proje-yapısı)
- [Geliştirme Kuralları](#geliştirme-kuralları)
- [Veritabanı Yapısı](#veritabanı-yapısı)
- [API Routes](#api-routes)
- [Katkıda Bulunma](#katkıda-bulunma)
- [Lisans](#lisans)

## 🎯 Proje Hakkında

Horde Sports, spor haberleri yayınlamak ve yönetmek için geliştirilmiş bir Laravel tabanlı web uygulamasıdır. Kullanıcılar en güncel spor haberlerini okuyabilir, yazarları takip edebilir ve kategorilere göre haberleri filtreleyebilir. Admin paneli üzerinden haberler, yazarlar ve kategoriler kolayca yönetilebilir.

## 🛠 Teknolojiler

### Backend
- **PHP**: ^8.2
- **Laravel Framework**: ^12.0
- **MySQL**: Veritabanı

### Frontend
- **Blade Template Engine**: Laravel'in template motoru
- **CSS3**: Custom CSS (12 kolonlu grid sistemi)
- **JavaScript**: Vanilla JS
- **FontAwesome**: İkonlar için CDN

### Diğer
- **Composer**: PHP bağımlılık yönetimi
- **Artisan CLI**: Laravel komut satırı aracı

## ✨ Özellikler

### Frontend Özellikleri
- ✅ Ana sayfa (Son haberler ve analizler)
- ✅ Kategori sayfaları (Slug bazlı routing)
- ✅ Haber detay sayfaları
- ✅ Yazarlar listesi ve yazar detay sayfaları
- ✅ Blog sayfası
- ✅ Arama fonksiyonu (UI hazır)
- ✅ Breadcrumb navigasyon
- ✅ Responsive tasarım (Mobil, Tablet, Desktop)
- ✅ 404 Error sayfası

### Admin Panel Özellikleri
- ✅ Dashboard (İstatistikler)
- ✅ Haber Yönetimi (CRUD)
- ✅ Yazar Yönetimi (CRUD)
- ✅ Kategori Yönetimi (CRUD)
- ✅ Rich Text Editor (Quill.js)
- ✅ Resim yükleme ve yönetimi

### Sistem Özellikleri
- ✅ Kullanıcı Authentication (Login/Register)
- ✅ Admin Middleware (Yetki kontrolü)
- ✅ Slug otomatik oluşturma
- ✅ Image upload ve storage yönetimi
- ✅ SEO-friendly URL yapısı

## 📦 Gereksinimler

Projeyi çalıştırmak için aşağıdaki yazılımların yüklü olması gerekir:

- **PHP**: 8.2 veya üzeri
- **Composer**: En son sürüm
- **MySQL**: 5.7 veya üzeri (veya MariaDB 10.3+)
- **Node.js**: 18.x veya üzeri (Opsiyonel, sadece build için)
- **Web Server**: Apache veya Nginx (veya `php artisan serve`)

## 🚀 Kurulum

### 1. Projeyi Klonlayın

```bash
git clone <repository-url>
cd horde-sports
```

### 2. Bağımlılıkları Yükleyin

```bash
composer install
```

### 3. Ortam Dosyasını Yapılandırın

`.env.example` dosyasını kopyalayın ve `.env` olarak adlandırın:

```bash
cp .env.example .env
```

`.env` dosyasını düzenleyin ve veritabanı bilgilerinizi girin:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=horde_sports
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Uygulama Anahtarı Oluşturun

```bash
php artisan key:generate
```

### 5. Veritabanını Oluşturun

MySQL'de veritabanını oluşturun:

```sql
CREATE DATABASE horde_sports CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Migration'ları Çalıştırın

```bash
php artisan migrate
```

### 7. Storage Link'i Oluşturun

```bash
php artisan storage:link
```

### 8. Admin Kullanıcısı Oluşturun

Laravel Tinker kullanarak veya Artisan komutu ile admin kullanıcısı oluşturun:

```bash
php artisan tinker
```

Tinker içinde:

```php
$user = App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

Veya proje içinde `MakeUserAdmin` Artisan komutu varsa:

```bash
php artisan make:user-admin
```

### 9. Geliştirme Sunucusunu Başlatın

```bash
php artisan serve
```

Tarayıcınızda `http://localhost:8000` adresine gidin.

## 📖 Kullanım

### Frontend Kullanımı

1. **Ana Sayfa**: `http://localhost:8000/`
2. **Blog**: `http://localhost:8000/blog`
3. **Kategoriler**: `http://localhost:8000/kategori/{kategori-slug}`
4. **Yazarlar**: `http://localhost:8000/yazarlar`
5. **Haber Detay**: `http://localhost:8000/haber/{haber-slug}`

### Admin Panel Kullanımı

1. **Giriş Yapın**: `http://localhost:8000/login`
2. **Dashboard**: `http://localhost:8000/admin/dashboard`
3. **Haber Yönetimi**: `http://localhost:8000/admin/news`
4. **Yazar Yönetimi**: `http://localhost:8000/admin/authors`
5. **Kategori Yönetimi**: `http://localhost:8000/admin/categories`

### Artisan Komutları

#### Slug Oluşturma

Mevcut haberler ve yazarlar için slug oluşturma:

```bash
php artisan generate:news-slugs
php artisan generate:author-slugs
```

## 📁 Proje Yapısı

```
horde-sports/
├── app/
│   ├── Console/
│   │   └── Commands/          # Artisan komutları
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Admin panel controller'ları
│   │   │   ├── Frontend/      # Frontend controller'ları
│   │   │   └── AuthController.php
│   │   └── Middleware/        # Middleware'ler
│   └── Models/                # Eloquent modelleri
├── database/
│   ├── migrations/            # Veritabanı migration'ları
│   └── seeders/               # Veritabanı seed'leri
├── public/
│   └── front/
│       └── assets/
│           ├── css/
│           │   └── main.css   # Ana CSS dosyası
│           └── js/
│               └── main.js    # Ana JavaScript dosyası
├── resources/
│   └── views/
│       ├── admin/             # Admin panel view'ları
│       ├── errors/            # Error sayfaları (404, 500, vb.)
│       └── front/             # Frontend view'ları
│           ├── pages/         # Sayfa view'ları
│           └── partials/      # Partial view'lar
├── routes/
│   └── web.php                # Web route tanımları
├── rules.md                   # Geliştirme kuralları (ÖNEMLİ!)
└── README.md                  # Bu dosya
```

## 📝 Geliştirme Kuralları

**ÖNEMLİ**: Projede çalışmaya başlamadan önce mutlaka [`rules.md`](rules.md) dosyasını okuyunuz!

### Özet Kurallar

1. ✅ **Blade Template**: `@extends('front.base')` ve `@section('content')` kullanın
2. ✅ **CSS**: 12 kolonlu grid sistemi (`repeat(12, 1fr)`) ve `grid-column: span X` kullanın
3. ✅ **CSS Birimleri**: Sadece `px` kullanın (rem, em, vh, vw yasak)
4. ✅ **HTML Etiketleri**: Her sayfada sadece bir H1 (`.title` class'ı ile), H2-H6 kullanmayın
5. ✅ **CSS Değişkenleri**: Tüm tekrar eden değerler için `:root` değişkenleri kullanın
6. ✅ **Partials**: Modüler yapı için partials kullanın
7. ✅ **İsimlendirme**: Class/ID isimleri İngilizce, yorumlar Türkçe
8. ❌ **Yasak**: Tailwind CSS, Vite, React/Vue/Angular, Inline CSS/JS

Detaylar için [`rules.md`](rules.md) dosyasına bakınız.

## 🗄️ Veritabanı Yapısı

### Tablolar

#### users
- `id` (Primary Key)
- `name`
- `email` (Unique)
- `password`
- `role` (admin/user)
- `timestamps`

#### authors
- `id` (Primary Key)
- `name`
- `slug` (Unique)
- `bio` (Nullable, Text)
- `photo` (Nullable)
- `timestamps`

#### categories
- `id` (Primary Key)
- `name`
- `slug` (Unique)
- `timestamps`

#### news
- `id` (Primary Key)
- `title`
- `slug` (Unique)
- `content` (Text)
- `image` (Nullable)
- `author_id` (Foreign Key → authors)
- `category_id` (Foreign Key → categories)
- `timestamps`

### İlişkiler

- `News` belongsTo `Author`
- `News` belongsTo `Category`
- `Author` hasMany `News`
- `Category` hasMany `News`

## 🌐 API Routes

### Frontend Routes

| Method | URL | Açıklama |
|--------|-----|----------|
| GET | `/` | Ana sayfa |
| GET | `/blog` | Blog listesi |
| GET | `/kategori/{slug}` | Kategori sayfası |
| GET | `/yazarlar` | Yazarlar listesi |
| GET | `/yazar/{slug}` | Yazar detay sayfası |
| GET | `/haber/{slug}` | Haber detay sayfası |
| GET | `/login` | Giriş sayfası |
| POST | `/login` | Giriş işlemi |
| GET | `/register` | Kayıt sayfası |
| POST | `/register` | Kayıt işlemi |
| POST | `/logout` | Çıkış işlemi |

### Admin Routes (Auth + Admin Middleware)

| Method | URL | Açıklama |
|--------|-----|----------|
| GET | `/admin/dashboard` | Dashboard |
| GET | `/admin/news` | Haberler listesi |
| GET | `/admin/news/create` | Yeni haber ekle |
| POST | `/admin/news` | Haber kaydet |
| GET | `/admin/news/{id}/edit` | Haber düzenle |
| PUT | `/admin/news/{id}` | Haber güncelle |
| DELETE | `/admin/news/{id}` | Haber sil |
| GET | `/admin/authors` | Yazarlar listesi |
| GET | `/admin/authors/create` | Yeni yazar ekle |
| POST | `/admin/authors` | Yazar kaydet |
| GET | `/admin/authors/{id}/edit` | Yazar düzenle |
| PUT | `/admin/authors/{id}` | Yazar güncelle |
| DELETE | `/admin/authors/{id}` | Yazar sil |
| GET | `/admin/categories` | Kategoriler listesi |
| GET | `/admin/categories/create` | Yeni kategori ekle |
| POST | `/admin/categories` | Kategori kaydet |
| GET | `/admin/categories/{id}/edit` | Kategori düzenle |
| PUT | `/admin/categories/{id}` | Kategori güncelle |
| DELETE | `/admin/categories/{id}` | Kategori sil |

## 🔧 Geliştirme

### CSS Geliştirme

CSS dosyası: `public/front/assets/css/main.css`

- 12 kolonlu grid sistemi kullanın
- CSS root değişkenlerini (`:root`) kullanın
- Sadece `px` birimini kullanın
- Türkçe yorumlar ekleyin

### JavaScript Geliştirme

JavaScript dosyası: `public/front/assets/js/main.js`

- Inline JavaScript kullanmayın
- Vanilla JavaScript kullanın
- DOMContentLoaded event'lerini kullanın

### Blade Template Geliştirme

- Base template: `resources/views/front/base.blade.php`
- Partials: `resources/views/front/partials/`
- Pages: `resources/views/front/pages/`

## 🐛 Sorun Giderme

### Storage Link Sorunu

```bash
php artisan storage:link
```

### Cache Temizleme

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Permission Sorunları (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için `LICENSE` dosyasına bakınız.

## 🤝 Katkıda Bulunma

1. Fork edin
2. Feature branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Commit edin (`git commit -m 'Add some amazing feature'`)
4. Push edin (`git push origin feature/amazing-feature`)
5. Pull Request açın

**Not**: Lütfen değişiklik yapmadan önce [`rules.md`](rules.md) dosyasını okuyunuz!

## 📞 İletişim

Sorularınız veya önerileriniz için issue açabilirsiniz.

---

**Not**: Bu proje geliştirme aşamasındadır. Production kullanımı için ek güvenlik önlemleri ve testler gerekebilir.
