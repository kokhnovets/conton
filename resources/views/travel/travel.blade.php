@extends('layouts.base')
@section('title', 'Все актуальные заказы, которые нужно доставить!')
@section('title', 'Все заказы')
@section('main')
    <div class="all-orders">
        <div class="container">
            <div>
                @if($count)
                    <p class="fs-5 pt-5 ms-2 pb-3 fw-bold">{{ $count ? 'Всего актуальных заказов для вас: ' . $count : ''}}</p>
                    <div class="order__rows">
                        @foreach($orders as $index => $order)
                            <div href="#" class="order__row d-flex flex-wrap justify-content-center flex-lg-nowrap align-items-center pt-3 ps-3 pe-3 m-2 text-decoration-none">
                                <div class="order__image me-lg-4 me-0 mb-2 mb-lg-0">
                                    @if(count($order->images) == 1)
                                        @foreach($order->images as $image)
                                            <div>
                                                <img src="{{ Storage::url($image->url) }}" class="d-block object-fit-cover" alt="{{ $image->title }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div id="carouselExampleAutoplaying{{ $index }}" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($order->images as $indexImage => $image)
                                                    @if($indexImage == 0)
                                                        <div class="carousel-item active">
                                                            <img src="{{ Storage::url($image->url) }}" class="d-block object-fit-cover" alt="{{ $image->title }}">
                                                        </div>
                                                    @else
                                                        <div class="carousel-item">
                                                            <img src="{{ Storage::url($image->url) }}" class="d-block object-fit-cover" alt="{{ $image->title }}">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying{{ $index }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying{{ $index }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="order__information w-100 h-100">
                                    <h3 class="h3 mb-3 fw-bold">{{ $order->appellation }}</h3>
                                    <p class="order__way-delivery-time fs-6">{{ $order->delivery_from }} &#10230; {{ $order->where_to_deliver }}, не позднее {{ Jenssegers\Date\Date::parse($order->deliver_to)->format('j F Y г.') }}</p>
                                    <a class="text-decoration-none order__user d-inline-flex pe-2 align-items-center" href="{{ Auth::user()->isAdmin() ? route('admin.users.detail', $order->user->id) : route('user.detail.show', $order->user->id) }}">
                                        <img class="order__photo_profile_path object-fit-cover" src="{{ $order->user->photo_profile_path ? Storage::url($order->user->photo_profile_path) : URL::asset('images/lk/user.webp') }}"  alt="{{ $order->user->first_name }} {{ $order->user->last_name }}">
                                        <p class="" style="margin-bottom: 0;">{{ $order->user->first_name }} {{ $order->user->last_name }} заказал(а) {{ $order->dateAsCarbon->diffForHumans() }}</p>
                                    </a>
                                    <div class="where_to_order d-flex justify-content-between mb-1">
                                        <p class="fs-6 mb-0">Где приобрести</p>
                                        <a class="text-decoration-none fs-6 mb-0" href="{{ $order->product_link }}" target="_blank">{{ explode('/', $order->product_link)[2] }}</a>
                                    </div>
                                    <div class="order__price d-flex justify-content-between mb-1">
                                        <p class="fs-6 mb-0">Цена товара</p>
                                        <p class="fs-6 mb-0">{{ $order->price }} РУБ.</p>
                                    </div>
                                    <div class="order__award d-flex justify-content-between mb-1">
                                        <p class="fs-6 mb-0">Желаемое вознаграждение</p>
                                        <p class="fs-6 mb-0">{{ $order->award }} РУБ.</p>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary w-100 btn-lg">Посмотреть детали</a>
                                    </div>
                                    @if(\App\Models\OfferForDelivery::where('order_id', $order->id)->get()->count())
                                        <p class="text-center fs-6 py-3">Всего {{ count($order->offers) }} предложени{{ count($order->offers) == 1 ? 'e на ' . \App\Models\OfferForDelivery::where('order_id', $order->id)->get()->min('offer') . ' РУБ.' :
                                    (count($order->offers) >= 2 && count($order->offers) <= 4 ? 'я от ' . \App\Models\OfferForDelivery::where('order_id', $order->id)->get()->min('offer') . ' РУБ. до ' . \App\Models\OfferForDelivery::where('order_id', $order->id)->get()->max('offer') . ' РУБ.' :
                                     (count($order->offers) >= 5 ? 'ий от '  . \App\Models\OfferForDelivery::where('order_id', $order->id)->get()->min('offer') . ' РУБ. до ' . \App\Models\OfferForDelivery::where('order_id', $order->id)->get()->max('offer') . ' РУБ.' : '')) }}</p>
                                    @else
                                        <p class="text-center fs-6 py-2">Предложений пока что нет.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="order__pagination">
                        {{ $orders->links() }}
                    </div>
                @else
                    <h3 class="h3 pt-5 pb-5 fw-bold text-center">
                        На данный момент нет актуальных заказов для вас.
                    </h3>
                @endif
            </div>
        </div>
    </div>
@endsection
