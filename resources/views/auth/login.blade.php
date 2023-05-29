@extends('layouts.base')
@section('desc', 'Авторизация на сайте Conton')
@section('title', 'Авторизация')
@section('main')
    <div class="login">
        <div class="container">
            <div class="signin-content d-lg-flex justify-content-center pt-5">
                <div class="signin-image d-inline-flex d-none d-lg-block">
                    <img src="{{ URL::asset('images/login/sign-in.svg') }}" alt="sing in image">
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Войти в аккаунт</h2>
                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input placeholder="Адрес электронной почты" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">Адрес электронной почты</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="show-hide__password">
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input placeholder="Пароль" id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded" name="password" required autocomplete="current-password" spellcheck="false" autocorrect="off" autocapitalize="off">
                                    <label for="password">Пароль</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <button id="toggle-password" tabindex="-1" type="button" class="toggle-password d-none">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
                                <div class="form-check mb-2 sm-mb-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label login-checkbox" for="remember">Запомнить меня</label>
                                </div>
                                <p class="link-regin m-0">Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary">Войти</button>
                                @if (Route::has('password.request'))
                                    <a class="forgot_password" href="{{ route('password.request') }}">Забыли пароль?</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
