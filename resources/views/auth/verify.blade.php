@extends('layouts.base')
@section('title', 'Подтверждение адреса электронной почты')
@section('main')
    <div class="email-verify">
        <div class="container">
            <div class="signup-content d-lg-flex justify-content-center pt-5">
                <div class="signup-image d-inline-flex d-none d-lg-block">
                    <img src="{{ URL::asset('images/email-verify/email-verify.svg') }}" alt="email verify">
                </div>
                <div class="email-verify-content">
                    <h2 class="h2 mb-3">Подтверждение электронного адреса</h2>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            На ваш электронный адрес была отправлена новая ссылка для подтверждения.
                        </div>
                    @endif
                    <p class="fs-6 mb-3">Прежде чем пользоваться сервисом, пожалуйста, подтвердите электронный адрес, писмо с ссылкой на подтверждение отправлено на ваш электронынй адрес.</p>
                    <p class="fs-6 mb-3">Если письмо не пришло, проверьте папку СПАМ или можете повторно отправить письмо</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Отправить письмо с подтверждением повторно</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
