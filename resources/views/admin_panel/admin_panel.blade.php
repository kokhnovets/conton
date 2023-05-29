@extends('layouts.base')
@section('title', 'Панель администратора')
@section('main')
    <div class="container">
        <h3 class="h3 my-3 fw-bold">Панель администратора</h3>
        <div class="admin-rows d-flex flex-lg-nowrap flex-wrap gap-2 my-4">
            <div class="admin-block bg-white gap-4 border border-4 rounded-pill d-flex align-items-center justify-content-center">
                <div class="admin-image w-25 pt-2">
                    <img src="{{ URL::asset('images/admin/main_panel/all_orders.png') }}" class="img-fluid" alt="Все заказы">
                </div>
                <div class="admin-text-info d-flex flex-column flex-nowrap pb-2">
                    <p class="fs-6">Заказов всего</p>
                    <p class="fs-4 fw-bold">{{ $allOrders }}</p>
                </div>
            </div>
            <div class="admin-block bg-white gap-4 border border-4 rounded-pill d-flex align-items-center justify-content-center">
                <div class="admin-image w-25 pt-2">
                    <img src="{{ URL::asset('images/admin/main_panel/order_sussess.png') }}" class="img-fluid" alt="Выполненных заказов">
                </div>
                <div class="admin-text-info d-flex flex-column flex-nowrap pb-2">
                    <p class="fs-6">Выполненных заказов</p>
                    <p class="fs-4 fw-bold">{{ $sussesOrders }}</p>
                </div>
            </div>
            <div class="admin-block bg-white gap-4 border border-4 rounded-pill d-flex align-items-center justify-content-center">
                <div class="admin-image w-25 pt-2">
                    <img src="{{ URL::asset('images/admin/main_panel/order_v_puti.png') }}" class="img-fluid" alt="Заказов в пути">
                </div>
                <div class="admin-text-info d-flex flex-column flex-nowrap pb-2">
                    <p class="fs-6">Заказов в пути</p>
                    <p class="fs-4 fw-bold">{{ $deliveryOrders }}</p>
                </div>
            </div>

        </div>
        <div class="d-flex flex-column">
            <a href="{{ route('admin.users') }}" class="text-decoration-none mb-2">Пользователи</a>
            <a href="{{ route('admin.orders') }}" class="text-decoration-none mb-2">Заказы</a>
            <a href="{{ route('admin.news.show.form') }}" class="text-decoration-none mb-2">Добавить новость</a>
            <a href="{{ route('admin.feedbacks') }}" class="text-decoration-none mb-2">Обратная связь</a>
        </div>
    </div>
@endsection
