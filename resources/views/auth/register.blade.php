@extends('layouts.base')
@section('desc', 'Регистрация на сайте Conton')
@section('title', 'Регистрация')
@section('main')
    <div class="regin">
        <div class="container">
            <div class="signup-content d-lg-flex justify-content-center pt-5">
                <div class="signup-image d-inline-flex d-none d-lg-block">
                    <img src="{{ URL::asset('images/regin/sign-up.svg') }}" alt="sing up image">
                </div>
                <div class="signup-form">
                    <h2 class="form-title">Зарегистрировать аккаунт</h2>
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input id="first_name" placeholder="Имя" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                            <label for="first_name">Имя</label>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input id="last_name" placeholder="Фамилия" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                            <label for="last_name">Фамилия</label>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input id="email" placeholder="Адрес электронной почты" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                    <input placeholder="Пароль" id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded" name="password" required autocomplete="new-password" spellcheck="false" autocorrect="off" autocapitalize="off">
                                    <label for="password">Пароль</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <button id="toggle-password" type="button" class="toggle-password d-none" tabindex="-1"></button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input placeholder="Подтвердите пароль" id="password-confirm" type="password" class="form-control rounded" name="password_confirmation" required autocomplete="new-password" spellcheck="false" autocorrect="off" autocapitalize="off">
                                    <label for="password-confirm">Подтвердите пароль</label>
                                    <button id="toggle-password" type="button" class="toggle-password d-none" tabindex="-1"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="d-flex justify-content-between flex-column d-sm-flex d-sm-row">
                                <button type="submit" class="btn btn-primary">
                                    Зарегистрироваться
                                </button>
                                <p class="link-login text-end mt-2 mb-0">Уже зарегистрированы? <a href="{{ route('login') }}">Войти</a></p>
                            </div>
                            <p class="w-80 fs-sm mt-3 terms_policy">Изпользуя Conton, я принимаю
                            <a href="{{ route('terms') }}" target="_blank">Условия использования</a>
                                и соглашаюсь на обработку персональных данных, описанную в
                            <a href="{{ route('policy') }}" target="_blank">Политике конфиденциальности</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
