<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    @yield('css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kranky&display=swap" rel="stylesheet">

</head>

<body>
    <header class="main-header">
        <nav class="header__nav">
            @if (Auth::check())
                <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
                <div class="link__button1">
                    <a class="link__chat" href="#">chat</a>
                    <a class="link__thread" href="#">thread</a>
                </div>
                <div class="link__button2">
                    <a class="link__diary" href="#">diary</a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="button__logout">logout</button>
                    </form>
                </div>
            @else
                <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
                <div class="link__button1">
                    <a class="link__chat" href="#">chat</a>
                    <a class="link__thread" href="#">thread</a>
                </div>
                <div class="link__button2">
                    <a class="link__diary" href="#">diary</a>
                    <a class="link__login" href="/login">login</a>
                </div>
            @endif
        </nav>
    </header>
    <div class="container">
        <div class="side__content">
            <div class="content__user-name">user_name</div>
            <div class="content__search">search</div>
            <div class="content__diary">diary</div>
            <div class="content__thread">thread</div>
        </div>

        @yield('content')
    </div>
</body>

</html>
