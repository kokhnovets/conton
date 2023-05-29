@extends('layouts.base')
@section('title', 'Мои заказы')

@section('main')
    <div class="user-orders">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>{{ session('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="title pt-5 pb-2 mb-4 d-flex justify-content-between align-items-center user-orders__header">
                <h3 class="h3 text-dark">Заказы:</h3>
                <a href="{{ route('order.add') }}" class="btn btn-primary">Добавить заказ</a>
            </div>
            <div class="">
                <ul class="d-flex justify-content-around">
                    <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('user.orders') ? 'user-orders__active pb-2' : null }} {{ request()->routeIs('user.orders.posted') ? 'user-orders__active pb-2' : null }}" href="{{ route('user.orders.posted') }}">Размещенные</a></li>
                    <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('user.orders.active') ? 'user-orders__active pb-2' : null }}" href="{{ route('user.orders.active') }}">Активные</a></li>
                    <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('user.orders.completed') ? 'user-orders__active pb-2' : null }}" href="{{ route('user.orders.completed') }}">Полученные</a></li>
                </ul>
            </div>
            <div class="">
                @yield('user-orders')
            </div>
        </div>
    </div>
@endsection
