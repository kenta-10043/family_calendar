@extends('layouts.app')

@section('title', 'Diary')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/diary/diary.css') }}">
@endsection

@section('content')
    <div>
        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif


        <div>
            <span class="main-date">{{ $diaryDate }}</span>
            <h2 class="content-name">Diary</h2>
        </div>
        @forelse ($diaries as $diary)
            <div class="diary__items">
                <div class="diary__items-date">
                    <label class="diary__items-label" for="diary-date">Date</label>
                    <p class="diary__items-date" id="diary-date">
                        {{ Carbon\Carbon::parse($diary->date)->format('Y-m-d (D)') }}</p>
                </div>
                <div class="diary__items-title">
                    <label class="diary__items-label" for="diary-title">Title</label>
                    <p class="diary__items-title" id="diary-title"> {{ $diary->title }}</p>
                </div>
                <div>
                    <label class="diary__items-label" for="diary-content">Content</label>
                    <p class="diary__items-content" id="content">{{ $diary->content }} </p>
                </div>
                <a class="button-open" data-id="{{ $diary->id }}"><img class="detail__image"
                        src="{{ asset('storage/' . 'others/枠つきの羽根ペンのアイコン素材.png') }}"></a>
            </div>

            {{-- モーダル部分 --}}
            <div id="myModal-{{ $diary->id }}" class="modal">
                <button data-id="{{ $diary->id }}" class="button-close">close</button>
                <h2>{{ $diary->date }}</h2>
                <p>{{ $diary->title }}</p>
                <p>{{ $diary->content }}</p>

                <form action="{{ route('diary.update', ['id' => $diary->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="diary__content">
                        <div>
                            <input type="date" name="date" value="{{ $diary->date }}">
                        </div>

                        @error('date')
                            <div>{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="title">title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                placeholder="wite here">
                        </div>
                        @error('title')
                            <div>{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="content">本文</label>
                            <textarea name="content" id="content" cols="30" rows="10" placeholder="write here"></textarea>
                        </div>
                        @error('content')
                            <div>{{ $message }}</div>
                        @enderror

                        <button type="submit">更新</button>
                    </div>
                </form>

                <form action="{{ route('diary.destroy', ['id' => $diary->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit"><img class="detail__image"
                            src="{{ asset('storage/' . 'others/ゴミ箱のアイコン.png') }}"></button>
                </form>
            </div>

        @empty
        @endforelse

        {{ $diaries->links() }}

        {{-- 新規作成フォーム --}}
        <form action="{{ route('diary.store') }}" method="POST">
            @csrf
            <div class="diary__content">
                <div>
                    <input type="date" name="date" value="{{ old('date') ?? now()->toDateString() }}">
                </div>

                @error('date')
                    <div>{{ $message }}</div>
                @enderror

                <div>
                    <label for="title">title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        placeholder="wite here">
                </div>
                @error('title')
                    <div>{{ $message }}</div>
                @enderror


                <div>
                    <label for="content">本文</label>
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="write here"></textarea>
                </div>
                @error('content')
                    <div>{{ $message }}</div>
                @enderror

                <button type="submit">登録</button>
            </div>

        </form>
    </div>

    <script>
        let openButtons = document.querySelectorAll(".button-open");
        openButtons.forEach(button => {
            button.addEventListener('click', () => {
                let id = button.dataset.id;
                let modal = document.getElementById("myModal-" + id);
                modal.style.display = 'block';
            });
        });

        let closeButtons = document.querySelectorAll(".button-close");
        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                let id = button.dataset.id;
                let modal = document.getElementById("myModal-" + id);
                modal.style.display = 'none';
            });


        })
    </script>
@endsection
