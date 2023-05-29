@extends('layouts.base')
@section('desc', 'Страница с действиями сервиса Conton')
@section('title', 'Страница с действиями')
@section('main')
    <div class="home">
        <div class="container">
            <div class="row justify-content-center mt-5 pt-5">
                <div class="col-md-8">
                    <h3 class="h3 fw-bold text-center mb-3">
                        Что вы хотите сделать?
                    </h3>
                    <a class="btn btn-primary w-100 mb-2" href="{{ route('order.add') }}">Заказать через Conton</a>
                    <a class="btn btn-primary w-100 mb-2" href="{{ route('travel') }}">Доставить через Conton</a>
                </div>
            </div>
        </div>
    </div>
@endsection
