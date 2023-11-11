@extends('layouts.app')

@section('content')

<head>
  <title>Авторизация | ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/admin/index/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/index/styles.css') }}">
</head>

<body>
  <section class="login">
      <header class="login__header">
        <h2 class="login__title">Авторизация</h2>
      </header>
      <div class="login__wrapper">
        <form method="POST" action="{{ route('login') }}" class="login__form" accept-charset="utf-8">
          @csrf
          <label class="login__label" for="email">
            {{ __('Email Address') }}
            <input class="login__input form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" placeholder="example@domain.xyz" name="email" autocomplete="email" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </label>
          <label class="login__label" for="password">
            {{ __('Password') }}
            <input class="login__input form-control @error('password') is-invalid @enderror" type="password" placeholder="" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </label>
          <div class="text-center">
            <input value="Авторизоваться" type="submit" class="login__button btn btn-primary">
          </div>
        </form>
      </div>
  </section>
</body>

@endsection