@extends('layouts.base')
@section('title', 'Настройки профиля')
@section('main')
<div class="lk pb-5">
    <h2 class="h2 pt-5 pb-5 text-center">Настройки</h2>
    <div class="container">
        <div class="lk__body d-flex flex-wrap flex-lg-nowrap">
            <div class="tabs-lk mb-2 mb-lg-0">
                <div class="tabs-lk__body">
                    <div class="tabs-lk__nav">
                        <ul class="tabs-lk__links mt-3 mb-3">
                            <li class="tabs-lk__link"><a class="h5 settings-link settings-link-profile {{ request()->routeIs('user.settings.profile') ? 'settings-link-active' : null }} {{ request()->routeIs('user.settings') ? 'settings-link-active' : null }}" href="{{ route('user.settings.profile') }}">Настройки профиля</a></li>
                            <li class="tabs-lk__link"><a class="h5 settings-link settings-link-details {{ request()->routeIs('user.settings.details') ? 'settings-link-active' : null }}" href="{{ route('user.settings.details') }}">Детали аккаунта</a></li>
                            <li class="tabs-lk__link"><a class="h5 settings-link settings-link-phone {{ request()->routeIs('user.settings.phone') ? 'settings-link-active' : null }}" href="{{ route('user.settings.phone') }}">Телефон</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="lk-content">
                @yield('setting')
            </div>
        </div>
    </div>
</div>
@endsection
