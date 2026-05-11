<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espinoza S.A.C.')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body class="app-layout">
    @include('partials.sidebar')
    <main class="app-layout__main">
        @include('partials.header')
        <div class="app-layout__content">
            @yield('content')
        </div>
    </main>
    @if (session('notification'))
    <x-toast
        :statusCode="session('notification')['statusCode']"
        :message="session('notification')['message']" />
    @endif
</body>

</html>