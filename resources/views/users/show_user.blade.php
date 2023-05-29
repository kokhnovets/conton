@extends('layouts.base')
@section('desc', 'Пользователь' . ' ' . $user->first_name . ' ' . $user->last_name)
@section('title', 'Пользователь' . ' ' . $user->first_name . ' ' . $user->last_name)
@section('main')
    <div class="home">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex flex-wrap-reverse justify-content-center justify-content-lg-between w-75">
                    <div>
                        <h4 class="h4 fw-bold mb-4">{{ $user->first_name }} {{ $user->last_name }}</h4>
                        <p class="fs-5 mb-3">В сообществе с {{ Jenssegers\Date\Date::parse($user->created_at)->format('j F Y г.')}}</p>
                        <p class="fs-5 mb-3">Почта: {{ $user->email }}</p>
                        @if($user->about_me)
                            <p class="fs-5 mb-2">О себе:</p>
                            <p class="w-75 mb-3">{{ $user->about_me }}</p>
                        @endif
                        <p class="fs-5 mb-2 fw-bold">Маршрут:</p>
                        @if($user->where_from && $user->where)
                            <p class="fs-5">{{ $user->where_from }} &#10230; {{ $user->where }}</p>
                        @else
                            <p class="fs-5">У пользователя на данный момент нет маршрута.</p>
                        @endif
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <img class="mb-4 order__photo_profile_path-detail object-fit-cover" src="{{ $user->photo_profile_path ? Storage::url($user->photo_profile_path) : URL::asset('images/lk/user.png') }}"  alt="">
                        @if($user->id === Auth::id())
                            <a class="btn btn-primary" href="{{ route('user.settings.profile') }}">Редактировать профиль</a>
                        @endif
                    </div>
                </div>
                <div class="w-75 d-flex flex-lg-row flex-column align-items-start align-items-lg-center p-3 mt-5 bg-dark-subtle text-emphasis-dark">
                    <p class="pe-3">Подтвержденные данные<span class="d-inline d-lg-none">:</span></p>
                    <p class="vr me-lg-3 d-none d-lg-block"></p>
                    <div class="d-flex justify-content-between flex-column flex-lg-row">
                        <p class="me-3">
                            @if($user->email_verifed_at)
                                <i class="fa-regular fa-circle-check text-success"></i>
                                Электронная почта
                            @else
                                <i class="fa-regular fa-circle-xmark text-secondary"></i>
                                Электронная почта
                            @endif
                        </p>
                        <p>
                            @if($user->phone)
                                <i class="fa-regular fa-circle-check text-success"></i>
                                Номер телефона
                            @else
                                <i class="fa-regular fa-circle-xmark text-secondary"></i>
                                Номер телефона
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
