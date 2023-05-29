@extends('layouts.base')
@section('desc', 'Страница не найдена, к сожалению, 404 error')
@section('title', 'Страница не найдена, 404')
@section('main')
    <div class="err_404">
        <div class="container">
            <div class="err_body d-flex flex-column justify-content-center align-items-center pb-5">
                <div class="err_image mb-3">
                    <img class="img-fluid w-100" src="{{ URL::asset('images/status_code/404.svg') }}" alt="404">
                </div>
                <h2 class="err_title h2 mb-2">Страница не найдена</h2>
                <p class="err_text fs-5 text-center">К сожалению страница, которую вы искали, не найдена. Пожалуйста проверьте адрес страницы.</p>
                <a class="text-decoration-none text-primary fs-5" href="{{ route('index') }}">Вернуться на главную страницу</a>
            </div>
        </div>
    </div>
@endsection
