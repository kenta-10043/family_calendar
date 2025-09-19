@extends('layouts.app')

@section('title','会員登録')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
 <div>
    <form class="register__form" action="/register" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
    <h1>REGISTER FORM</h1>

    <label for="name" >NAME</label>
    <input name="name" id="name" type="text"  value="{{ old('name') }}" placeholder="名前を入力してください">
    <div class="form__error">
        @error('name')
        {{ $message }}
        @enderror
    </div>

    <label for="email" >EMAIL</label>
    <input name="email" id="email" type="email"  value="{{ old('email') }}" placeholder="メールアドレスを入力してください">
    <div class="form__error">
        @error('email')
        {{ $message }}
        @enderror
    </div>

    <label for="password" >PASSWORD</label>
    <input name="password" id="password" type="password" placeholder="パスワードを入力してください">
    <div class="form__error">
        @error('password')
        {{ $message }}
        @enderror
    </div>

    <label for="user_image">USER IMAGE</label>
    {{-- <img class="user__image" src="{{asset('storage/user_images/default.png')}}" alt="user_image"> --}}
    <input  id="user_image" type="file" name="user_image">
    <img class="preview__image" id="preview" src="#">
    <div class="form__error">
        @error('image')
        {{ $message }}
        @enderror
    </div>

    <label for="password_confirm" >CONFIRM PASSWORD</label>
    <input name="password_confirmation" id="password_confirm" type="password" placeholder="もう一度パスワードを入力してください">

    <div class="navigation-item"></div>
    <button class="register__button" type="submit">登録</button>
    <p><a class="login__link" href="/login">LOGIN HERE</a></p>
    </form>
</div>

<script>
        document.getElementById('user_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = "inline-block";
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = "none";
            }
        });
    </script>
@endsection
