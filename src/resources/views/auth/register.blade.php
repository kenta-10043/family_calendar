@extends('layouts.app')

@section('title','会員登録')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div>Register Form</div>
<div>
    <form action="/register" method="POST">
        @csrf
    <h1>REGISTER</h1>

    <label for="name" >NAME</label>
    <input name="name" id="name" type="text"  value="{{ old('name') }}">
    <div class="form__error">
        @error('name')
        {{ $message }}
        @enderror
    </div>

    <label for="email" >EMAIL</label>
    <input name="email" id="email" type="email"  value="{{ old('email') }}">
    <div class="form__error">
        @error('email')
        {{ $message }}
        @enderror
    </div>

    <label for="password" >PASSWORD</label>
    <input name="password" id="password" type="password" }}">
    <div class="form__error">
        @error('password')
        {{ $message }}
        @enderror
    </div>

    <label for="password_confirm" >CONFIRM PASSWORD</label>
    <input name="password_confirmation" id="password_confirm" type="password" }}">

    <button type="submit">登録</button>
    <a href="/login">ログインはこちら</a>
    </form>
</div>
@endsection
