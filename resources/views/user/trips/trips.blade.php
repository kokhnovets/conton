@extends('layouts.base')
@section('title', 'Мои поездки')
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
                <h3 class="h3 text-dark">Доставки</h3>
                <a href="{{ route('travel') }}" class="btn btn-primary">Доставить заказ</a>
            </div>
                <div class="">
                    <ul class="d-flex justify-content-around">
                        <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('user.trips') ? 'user-orders__active pb-2' : null }} {{ request()->routeIs('user.trips.active') ? 'user-orders__active pb-2' : null }}" href="{{ route('user.trips.active') }}">Активные</a></li>
                        <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('user.trips.completed') ? 'user-orders__active pb-2' : null }}" href="{{ route('user.trips.completed') }}">Доставленные</a></li>
                    </ul>
                </div>
                <div class="">
                    @yield('trips')
                </div>
        </div>
    </div>
@endsection
