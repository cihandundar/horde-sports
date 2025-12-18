<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
</head>
<body>
    

@include('front.partials.header')

@yield('content')

@include('front.partials.footer')
<script src="{{ asset('front/assets/js/main.js') }}"></script>
</body>
</html>