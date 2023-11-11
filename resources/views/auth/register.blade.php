@extends('layouts.app')

@section('content')

<head>
  <title>Регистрация | ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/admin/index/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/index/styles.css') }}">
</head>

<body>
  <section class="login">
      <header class="login__header">
        <h2 class="login__title">Регистрация</h2>
      </header>
      <div class="login__wrapper">
        <form method="POST" action="{{ route('register') }}" class="login__form" accept-charset="utf-8">
            @csrf
            <div>
                <label for="name" class="login__label">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="login__input form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="email" class="login__label">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="login__input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="password" class="login__label">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="login__input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="password-confirm" class="login__label">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="login__input form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="login__button btn btn-primary">
                        {{ __('Регистрация') }}
                    </button>
                </div>
            </div>
        </form>
      </div>
  </section>
</body>

@endsection
