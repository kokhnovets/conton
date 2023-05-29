@extends('layouts.base')
@section('title', 'Сброс пароля')
@section('main')
    <div class="reset">
        <div class="container">
            <div class="reset-content d-lg-flex justify-content-center pt-5">
                <div class="reset-image d-inline-flex d-none d-lg-block">
                    <img class="w-100" src="{{ URL::asset('images/reset-password/reset-password.png') }}" alt="reset image">
                </div>
                <div class="reset-form d-lg-flex justify-content-center pt-5 flex-column">
                    <h2 class="form-title">Сбросить пароль</h2>
                    <form method="POST" action="{{ route('password.update') }}" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input placeholder="Адрес электронной почты" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
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
                            <div>
                                <button type="submit" class="btn btn-primary">Сбросить пароль</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
