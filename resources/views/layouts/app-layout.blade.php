<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espinoza S.A.C.')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include('partials.sidebar')
    <main>
        @include('partials.header')
        @yield('content')
        @include('partials.footer')
    </main>
</body>

</html>