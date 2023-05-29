@extends('layouts.base')
@section('desc', 'Мы ценим ваше мнение и всегда готовы услышать ваши отзывы и предложения. Пожалуйста, свяжитесь с нами, используя форму обратной связи, и мы постараемся ответить вам как можно скорее. Ваши комментарии помогают нам улучшать сервис и делать его более удобным для вас.')
@section('title', 'Форма обратной связи')
@section('main')
    <div class="regin">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>{{ session('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="signup-content d-lg-flex justify-content-center pt-5">
                <div class="signup-image d-inline-flex d-none d-lg-block">
                    <img src="{{ URL::asset('images/feedback/feedback.svg') }}" alt="sing up image">
                </div>
                <div class="signup-form">
                    <h2 class="form-title">Форма обратной связи</h2>
                    <form method="POST" action="{{ route('feedback.store') }}" novalidate>
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
                            <input id="email" placeholder="Почта для связи" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">Почта</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input id="theme" placeholder="Тема" type="text" class="form-control @error('theme') is-invalid @enderror" name="theme" value="{{ old('theme') }}">
                            <label for="theme">Тема</label>
                            @error('theme')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <textarea contenteditable class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="5" style="resize: none; min-height: 100px;" placeholder="Сообщение">{{ old('message') }}</textarea>
                            <label for="description">Сообщение</label>
                            @error('message')
                            <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="row mb-0">
                            <div class="d-flex justify-content-between flex-column d-sm-flex d-sm-row">
                                <button type="submit" class="btn btn-primary">
                                    Отправить
                                </button>
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
