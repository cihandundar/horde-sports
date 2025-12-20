@php
    // Breadcrumb öğeleri - View'lardan gelen verileri kullanarak dinamik oluştur
    if (!isset($breadcrumbItems)) {
        $breadcrumbItems = [];
        
        // Her zaman Ana Sayfa ile başla
        $breadcrumbItems[] = [
            'title' => 'Ana Sayfa',
            'url' => route('home'),
            'active' => false
        ];
        
        // View'lardan gelen verilere göre breadcrumb oluştur
        
        // Haber detay sayfası - $news değişkeni varsa VE bir model instance'ı ise (pagination değilse)
        // Pagination objelerinde 'links' method'u vardır, modellerde yoktur
        if (isset($news) && $news && isset($news->title) && !method_exists($news, 'links')) {
            // Blog breadcrumb'ı
            $breadcrumbItems[] = [
                'title' => 'Blog',
                'url' => route('blog.index'),
                'active' => false
            ];
            
            // Kategori varsa kategori breadcrumb'ı
            if (isset($news->category) && $news->category && !empty($news->category->slug)) {
                $breadcrumbItems[] = [
                    'title' => $news->category->name,
                    'url' => route('category.show', $news->category->slug),
                    'active' => false
                ];
            }
            
            // Haber breadcrumb'ı
            $breadcrumbItems[] = [
                'title' => $news->title,
                'url' => !empty($news->slug) ? route('news.show', $news->slug) : '#',
                'active' => true
            ];
        }
        // Kategori sayfası - $category değişkeni varsa
        elseif (isset($category) && $category) {
            // Blog breadcrumb'ı
            $breadcrumbItems[] = [
                'title' => 'Blog',
                'url' => route('blog.index'),
                'active' => false
            ];
            
            // Kategori breadcrumb'ı
            $breadcrumbItems[] = [
                'title' => $category->name,
                'url' => !empty($category->slug) ? route('category.show', $category->slug) : '#',
                'active' => true
            ];
        }
        // Yazar detay sayfası - $author değişkeni varsa
        elseif (isset($author) && $author) {
            // Yazarlar breadcrumb'ı
            $breadcrumbItems[] = [
                'title' => 'Yazarlar',
                'url' => route('authors.index'),
                'active' => false
            ];
            
            // Yazar breadcrumb'ı
            $breadcrumbItems[] = [
                'title' => $author->name,
                'url' => !empty($author->slug) ? route('author.show', $author->slug) : '#',
                'active' => true
            ];
        }
        // Diğer sayfalar için route name'e göre
        else {
            try {
                $currentRoute = request()->route()->getName();
                
                switch ($currentRoute) {
                    case 'home':
                        // Ana sayfada sadece Ana Sayfa göster
                        $breadcrumbItems = [
                            [
                                'title' => 'Ana Sayfa',
                                'url' => route('home'),
                                'active' => true
                            ]
                        ];
                        break;
                        
                    case 'blog.index':
                        $breadcrumbItems[] = [
                            'title' => 'Blog',
                            'url' => route('blog.index'),
                            'active' => true
                        ];
                        break;
                        
                    case 'search':
                        $breadcrumbItems[] = [
                            'title' => 'Arama Sonuçları',
                            'url' => request()->fullUrl(),
                            'active' => true
                        ];
                        break;
                        
                    case 'authors.index':
                        $breadcrumbItems[] = [
                            'title' => 'Yazarlar',
                            'url' => route('authors.index'),
                            'active' => true
                        ];
                        break;
                        
                    case 'login':
                        $breadcrumbItems[] = [
                            'title' => 'Giriş Yap',
                            'url' => route('login'),
                            'active' => true
                        ];
                        break;
                        
                    case 'register':
                        $breadcrumbItems[] = [
                            'title' => 'Kayıt Ol',
                            'url' => route('register'),
                            'active' => true
                        ];
                        break;
                }
            } catch (\Exception $e) {
                // Route bulunamazsa sadece Ana Sayfa göster
                $breadcrumbItems = [
                    [
                        'title' => 'Ana Sayfa',
                        'url' => route('home'),
                        'active' => true
                    ]
                ];
            }
        }
    }
@endphp

@if(count($breadcrumbItems) > 0)
<nav class="breadcrumb" aria-label="Breadcrumb">
    @foreach($breadcrumbItems as $index => $item)
        @php
            // URL kontrolü - Eğer URL oluşturulamazsa bu item'ı atla
            $itemUrl = '#';
            try {
                if (isset($item['url']) && !empty($item['url'])) {
                    $itemUrl = $item['url'];
                }
            } catch (\Exception $e) {
                // URL oluşturulamazsa # kullan
                $itemUrl = '#';
            }
        @endphp
        
        @if($item['active'])
            <span class="breadcrumb-item active">{{ $item['title'] }}</span>
        @else
            @if($itemUrl !== '#')
                <a href="{{ $itemUrl }}" class="breadcrumb-item">{{ $item['title'] }}</a>
            @else
                <span class="breadcrumb-item">{{ $item['title'] }}</span>
            @endif
        @endif
        
        @if(!$loop->last)
            <span class="breadcrumb-separator">/</span>
        @endif
    @endforeach
</nav>
@endif
