<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'پنل ادمین')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- استایل پایه --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">داشبورد</a>

        <div class="ms-auto d-flex gap-2">
<a href="{{ route('admin.profile-fields.index') }}" class="btn btn-sm btn-warning">مدیریت فیلدهای پروفایل</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-danger">خروج</button>
            </form>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

</body>
</html>
