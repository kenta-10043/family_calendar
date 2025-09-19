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
            {{-- @if (Auth::check()) --}}
                <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
                {{-- <div class="link__button1">
                    <a class="button__chat" href="{{}}">chat</a>
                    <a class="button__thread" href="{{  }}">thread</a>
                </div>
                <div class="link__button2">
                    <a class="button__diary" href="{{ route('sell.index') }}">diary</a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="button__logout">ログアウト</button>
                    </form>
                </div>
            @else--}}
                {{-- <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
                <div class="link__button1">
                    <a class="button__chat" href="{{ route('profile.index') }}">chat</a>
                    <a class="button__thread" href="{{ route('profile.index') }}">thread</a>
                </div> --}}
                <div class="link__button2">
                    {{-- <a class="button__diary" href="{{ route('sell.index') }}">diary</a> --}}
                    <form action="/login" method="post">
                        @csrf
                        <button class="button__login">login</button>
                    </form>
                </div>
            {{-- @endif --}}
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
