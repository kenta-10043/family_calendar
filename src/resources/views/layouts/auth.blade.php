<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kranky&display=swap" rel="stylesheet">
</head>

<body>
    @if (Auth::check() && Auth::user()->hasVerifiedEmail())
        <header class="main-header">
            <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
        </header>
    @elseif(Auth::check())
        <header class="main-header">
            <a class="title-name" href="/email/verify">
                Family Calendar
            </a>
        </header>
    @else
        <header class="main-header">
            <a class="title-name" href="/login">Family Calendar</a>
        </header>
    @endif
    @yield('content')

</body>

</html>
