@php
    // Breadcrumb öğeleri - Eğer manuel olarak verilmediyse otomatik oluştur
    if (!isset($breadcrumbItems)) {
        $breadcrumbItems = [];
        
        // Route kontrolü - Route yoksa breadcrumb gösterme
        try {
            $currentRoute = request()->route()->getName();
            $routeParams = request()->route()->parameters();
        } catch (\Exception $e) {
            $currentRoute = null;
            $routeParams = [];
        }
        
        // Route yoksa breadcrumb oluşturma
        if (!$currentRoute) {
            $breadcrumbItems = [];
        }
        
        // Her zaman Ana Sayfa ile başla
        $breadcrumbItems[] = [
            'title' => 'Ana Sayfa',
            'url' => route('home'),
            'active' => false
        ];
        
        // Route name'e göre breadcrumb oluştur
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
                
            case 'category.show':
                // Kategori slug'ından kategori bilgisini al
                if (isset($routeParams['slug'])) {
                    $category = \App\Models\Category::where('slug', $routeParams['slug'])->first();
                    if ($category) {
                        $breadcrumbItems[] = [
                            'title' => 'Blog',
                            'url' => route('blog.index'),
                            'active' => false
                        ];
                        $breadcrumbItems[] = [
                            'title' => $category->name,
                            'url' => route('category.show', $category->slug),
                            'active' => true
                        ];
                    }
                }
                break;
                
            case 'news.show':
                // Haber slug'ından haber bilgisini al
                if (isset($routeParams['slug'])) {
                    $news = \App\Models\News::where('slug', $routeParams['slug'])->with('category')->first();
                    if ($news) {
                        $breadcrumbItems[] = [
                            'title' => 'Blog',
                            'url' => route('blog.index'),
                            'active' => false
                        ];
                        $breadcrumbItems[] = [
                            'title' => $news->category->name,
                            'url' => route('category.show', $news->category->slug),
                            'active' => false
                        ];
                        $breadcrumbItems[] = [
                            'title' => $news->title,
                            'url' => route('news.show', $news->slug),
                            'active' => true
                        ];
                    }
                }
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
    }
@endphp

@if(count($breadcrumbItems) > 0)
<nav class="breadcrumb" aria-label="Breadcrumb">
    @foreach($breadcrumbItems as $index => $item)
        @if($item['active'])
            <span class="breadcrumb-item active">{{ $item['title'] }}</span>
        @else
            <a href="{{ $item['url'] }}" class="breadcrumb-item">{{ $item['title'] }}</a>
        @endif
        
        @if(!$loop->last)
            <span class="breadcrumb-separator">/</span>
        @endif
    @endforeach
</nav>
@endif
