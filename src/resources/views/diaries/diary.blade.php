@extends('layouts.app')

@section('title', 'Diary')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/diary/diary.css') }}">
@endsection

@section('content')

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <div>
        <div>
            <span>{{ $diaryDate }}</span>
            <h2>Diary</h2>
        </div>
        @forelse ($diaries as $diary)
            <div class="diary__items">
                <p class="diary__items-date"> {{ Carbon\Carbon::parse($diary->date)->format('Y-m-d (D)') }}</p>
                <div class="diary__items-title">
                    <label for="diary-title">title</label>
                    <span class="diary-title" id="diary-title"> {{ $diary->title }}</span>
                </div>
            </div>
            <p class="diary__items-content">{{ $diary->content }} </p>
            <button class="button-open" id="openBtu-{{ $diary->id }}">detail</button>

            <div id="myModal-{{ $diary->id }}" class="modal">
                <button id="closeBtu-{{ $diary->id }}" class="button-close">close</button>
                <h2>{{ $diary->date }}</h2>
                <p>{{ $diary->title }}</p>
                <p>{{ $diary->content }}</p>

                <form action=#" method="POST">
                    {{-- <form action="{{ route('diary.update', ['id' => $diary->id]) }}" method="POST"> --}}
                    @method('PUT')
                    @csrf
                    <div class="diary__content">
                        <div>
                            <input type="date" name="date" value="{{ $request->date ?? now()->toDateString() }}">
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
                <form action="#" method="POST">
                    {{-- <form action="{{ route('diary.destroy', ['id' => $diary->id]) }}" method="POST"> --}}
                    @method('DELETE')
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>

        @empty
        @endforelse

        {{ $diaries->links() }}

        <form action="{{ route('diary.store') }}" method="POST">
            @csrf
            <div class="diary__content">
                <div>
                    <input type="date" name="date" value="{{ $request->date ?? now()->toDateString() }}">
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
        let openBtu = document.getElementById("openBtu-{{ $diary->id }}");
        console.log(openBtu);
        openBtu.addEventListener('click', () => {
            document.getElementById("myModal-{{ $diary->id }}").style.display = 'block';
        });

        let closeBtu = document.getElementById("closeBtu-{{ $diary->id }}");
        closeBtu.addEventListener('click', () => {
            document.getElementById("myModal-{{ $diary->id }}").style.display = 'none';
        })
    </script>
@endsection
