@extends('layouts.base')
@section('title', 'Сброс пароля')
@section('main')
    <div class="email">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="email-content d-lg-flex justify-content-center pt-5">
                <div class="email-image d-inline-flex d-none d-lg-block">
                    <img src="{{ URL::asset('images/email/email.png') }}" alt="email image">
                </div>
                <div class="email-form d-lg-flex justify-content-center pt-5 flex-column">
                    <h2 class="form-title">Сбросить пароль</h2>
                    <form method="POST" action="{{ route('password.email') }}" novalidate>
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
