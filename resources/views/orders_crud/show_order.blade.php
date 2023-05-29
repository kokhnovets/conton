@extends('layouts.base')
@section('title', 'Заказ ' . $order['appellation'])
@section('title', 'Заказ ' . $order['appellation'])
@section('main')
    <div class="order-show pt-5 pb-5">
        <div class="container order-show__body p-5">
            <h2 class="h2 mb-3 fw-bold">Ваш заказ:</h2>
            <div class="order-show__header d-flex mb-3 align-items-center">
                <div class="order-show__image">
                    <img src="{{ Storage::url($images[0]->url) }}" alt="{{ $images[0]->title }}">
                </div>
                <div class="order-show__title ms-3 fw-bold">
                    <h3 class="h3">{{ $order['appellation'] }}</h3>
                </div>
            </div>
            <div class="border-top border-3">
                <div class="d-flex mt-2 mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Количество</p>
                    <p class="fs-6">{{ $order['count'] }}</p>
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Где приобрести</p>
                    <a class="text-decoration-none fs-6 mb-0" href="{{ $order['product_link'] }}" target="_blank">{{ explode('/', $order['product_link'])[2] }}</a>
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Доставить из</p>
                    <p class="fs-6">{{ $order['delivery_from'] }}</p>
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Доставить куда</p>
                    <p class="fs-6">{{ $order['where_to_deliver'] }}</p>
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Доставить до</p>
                    <p class="fs-6">{{ Jenssegers\Date\Date::parse($order['deliver_to'])->format('j F Y г.') }}</p>
                </div>
                @if($order['description'])
                    <div class="mb-2">
                        <p class="fs-6 fw-bold">Информация о товаре:</p>
                        <p class="fs-6 w-100 text-break">{{ $order['description'] }}</p>
                    </div>
                @endif
                @if($order['wishes'])
                    <div class="mb-2">
                        <p class="fs-6 fw-bold">Пожелания:</p>
                        <p class="fs-6 w-100 text-break">{{ $order['wishes'] }}</p>
                    </div>
                @endif
            </div>
            <div class="border-top border-3">
                <div class="d-flex mt-2 mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Стоимость товара</p>
                    <p class="fs-6">{{ number_format($order['price'], 2, '.', ' ') }} РУБ.</p>
                </div>
                <div class="d-flex mt-2 mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Вознаграждение</p>
                    <p class="fs-6">{{ number_format($order['award'], 2, '.', ' ') }} РУБ.</p>
                </div>
                <div class="d-flex mt-2 mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Комиссия Conton</p>
                    <p class="fs-6">{{ number_format($commission, 2, '.', ' ') }} РУБ.</p>
                </div>
                <div class="d-flex mt-2 mb-2 justify-content-between">
                    <p class="fs-6 fw-bold">Итоговая предварительная стоимость</p>
                    <p class="fs-6">{{ number_format($total, 2, '.', ' ') }} РУБ.</p>
                </div>
            </div>
            <div class="mt-3 w-100">
                <form action="{{ route('order.revoke') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <button type="submit" class="btn btn-primary w-100 btn-lg">Отменить заказ</button>
                    </div>
                </form>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <button type="submit" class="btn btn-primary w-100 btn-lg">Опубликовать заказ</button>
                    </div>
                </form>
            </div>
            <p class="w-80 terms_policy small">Публикуя заказ, я принимаю
                <a href="{{ route('terms') }}" target="_blank">Условия использования</a>
                и понимаю, что заказ может быть отменён, если она не соответствует стандартам.
            </p>
        </div>
    </div>
@endsection
