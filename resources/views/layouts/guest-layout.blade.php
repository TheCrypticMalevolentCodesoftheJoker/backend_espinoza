<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espinoza S.A.C.')</title>
    @vite(['resources/scss/app.scss', 'resources/js/guest.js'])
</head>

<body class="guest-layout">
    @yield('content')
    @if (session('notification'))
    <x-toast
        :statusCode="session('notification')['statusCode']"
        :message="session('notification')['message']" />
    @endif
</body>

</html>