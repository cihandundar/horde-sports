<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        @include('admin.partials.menu-sidebar')
        
        <div class="admin-main-wrapper">
            @include('admin.partials.header')
            
            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>
    
    <script src="{{ asset('admin/assets/js/admin.js') }}"></script>
</body>
</html>
