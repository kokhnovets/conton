@extends('user.trips.trips')
@section('trips')
    @if($count)
        <p class="fs-5 ms-2 pb-3 fw-bold">{{ $count ? 'Всего заказов к доставке: ' . $count : ''}}</p>
        <div class="order__rows">
            @foreach($orders as $index => $order)
                <div href="#"
                     class="order__row {{ $order->order_status == 2 ? 'opacity-50' : null }} d-flex flex-wrap justify-content-center flex-lg-nowrap align-items-center pt-3 ps-3 pe-3 m-2 text-decoration-none">
                    <div class="order__image me-lg-4 me-0 mb-2 mb-lg-0">
                        @if(count($order->images) == 1)
                            @foreach($order->images as $image)
                                <div>
                                    <img src="{{ Storage::url($image->url) }}" class="d-block object-fit-cover"
                                         alt="{{ $image->title }}">
                                </div>
                            @endforeach
                        @else
                            <div id="carouselExampleAutoplaying{{ $index }}" class="carousel carousel-dark slide"
                                 data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($order->images as $indexImage => $image)
                                        @if($indexImage == 0)
                                            <div class="carousel-item active">
                                                <img src="{{ Storage::url($image->url) }}"
                                                     class="d-block object-fit-cover" alt="{{ $image->title }}">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img src="{{ Storage::url($image->url) }}"
                                                     class="d-block object-fit-cover" alt="{{ $image->title }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleAutoplaying{{ $index }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleAutoplaying{{ $index }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="order__information w-100 h-100">
                        <h3 class="h3 mb-3 fw-bold">{{ $order->appellation }}</h3>
                        <p class="order__way-delivery-time mb-2 fs-6">{{ $order->delivery_from }}
                            &#10230; {{ $order->where_to_deliver }}, не
                            позднее {{ Jenssegers\Date\Date::parse($order->deliver_to)->format('j F Y г.') }}</p>
                        <a class="text-decoration-none d-inline-flex pe-2 align-items-center" href="{{ route('user.detail.show', $order->user->id) }}">
                            <img class="order__photo_profile_path object-fit-cover"
                                 src="{{ $order->user->photo_profile_path ? Storage::url($order->user->photo_profile_path) : URL::asset('images/lk/user.png') }}"
                                 alt="{{ $order->user->first_name }} {{ $order->user->last_name }}">
                            <p class=""
                               style="margin-bottom: 0;">{{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                        </a>
                        <div class="where_to_order d-flex justify-content-between mb-1">
                            <p class="fs-6 mb-0">Где приобрести</p>
                            <a class="text-decoration-none fs-6 mb-0" href="{{ $order->product_link }}"
                               target="_blank">{{ explode('/', $order->product_link)[2] }}</a>
                        </div>
                        <div class="order__price d-flex justify-content-between mb-1">
                            <p class="fs-6 mb-0">Цена товара</p>
                            <p class="fs-6 mb-0">{{ $order->price }} РУБ.</p>
                        </div>
                        <div class="order__award d-flex justify-content-between mb-1">
                            <p class="fs-6 mb-0">Вознаграждение</p>
                            <p class="fs-6 mb-0">{{ $order->award }} РУБ.</p>
                        </div>
                        <div class="">
                            <a href="{{ route('user.trips.active.detail', $order->id) }}"
                               class="btn btn-primary w-100 btn-lg">Посмотреть детали</a>
                        </div>
                        <p class="text-center fs-6 pt-3">Нажмите, чтобы изменить статус доставки</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="order__pagination">
            {{ $orders->links() }}
        </div>
    @else
        <h3 class="h3 pt-5 pb-5 fw-bold text-center">
            На данный момент у вас заказов к доставке нет.
        </h3>
    @endif
@endsection

