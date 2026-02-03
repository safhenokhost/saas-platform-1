<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'داشبورد')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
@yield('scripts')
<body>

<header style="padding: 16px; background:#222; color:#fff">
    خوش آمدی 👋 {{ auth()->user()->mobile ?? '' }}
</header>

<main style="padding: 24px">
    @yield('content')
</main>

</body>
</html>
