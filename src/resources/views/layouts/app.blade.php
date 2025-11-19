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
    {{-- @vite(['resources/js/app.js']) --}}

</head>

<body>
    <header class="main-header">
        <nav class="header__nav">
            @if (Auth::check())
                <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
                <div class="link__button1">
                    <a class="link__chat" id="btn" href="#">chat</a>
                    <a class="link__thread" href="#">thread</a>
                </div>
                <div class="link__button2">
                    <a class="link__diary" href="{{ route('diary.index') }}">diary</a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="button__logout">logout</button>
                    </form>
                </div>
            @else
                <a class="title-name" href="{{ route('schedule.calendar') }}">Family Calendar</a>
                <div class="link__button1">
                    <a class="link__chat" id="btn" href="#">chat</a>
                    <a class="link__thread" id="btn" href="#">thread</a>
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
            <div class="user__profile">
                <img class="user__image" src="{{ asset('storage/' . $targetUser->user_image) }}"
                    alt="{{ $targetUser->name }}">
                <div class="content__user-name">{{ $targetUser->name }}</div>
            </div>
            <div class="content__search">task search</div>
            <form action="{{ route('schedule.detail') }}">
                <input type="date" name="date">
                <button type="submit">検索</button>
            </form>

            <p class="user__diary">diary</p>
            <div class="content__diary">
                <p>{{ $latestDiary->date }}</p>
                <p class="content__diary-title">題名：{{ $latestDiary->title }}</p>
                <p class="content__diary-content">本文：{{ $latestDiary->content }}</p>
            </div>

            <div class="content__thread">thread</div>
        </div>

        @yield('content')
    </div>

    <script>
        const btns = document.querySelectorAll('.link__chat, .link__thread,.link__diary, .link__login');
        btns.forEach(function(btn) {
            btn.addEventListener('click', () => {
                btn.classList.add('big');
                console.log(`${btn.className}`);

                setTimeout(() => {
                    btn.classList.remove('big');
                }, 300);
            });
        });
    </script>

</body>

</html>
