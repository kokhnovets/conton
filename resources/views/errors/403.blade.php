@extends('layouts.base')
@section('desc', 'Доступ к этому разделу запрещен, 403 error')
@section('title', 'Доступ запрещён, 403')
@section('main')
    <div class="err_404">
        <div class="container">
            <div class="err_body d-flex flex-column justify-content-center align-items-center pb-5">
                <div class="err_image mb-3">
                    <img class="img-fluid w-100" src="{{ URL::asset('images/status_code/403.svg') }}" alt="404">
                </div>
                <h2 class="err_title h2 mb-2">У вас нет доступа к этой странице</h2>
                <a class="text-decoration-none text-primary fs-5" href="{{ route('index') }}">Вернуться на главную страницу</a>
            </div>
        </div>
    </div>
@endsection
