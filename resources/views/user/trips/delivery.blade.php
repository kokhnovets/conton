@extends('layouts.base')
@section('title', $order->appellation)

@section('main')
    <div class="order-details">
        <div class="container pt-5 pb-3">
            <div class="order-details__body mb-3">
                <div class="p-3">
                    @if(count($order->images) == 1)
                        @foreach($order->images as $image)
                            <div class="mb-3 mx-auto mw-100 order-details__image">
                                <img src="{{ Storage::url($image->url) }}" class="d-block w-50 mx-auto" alt="{{$image->title}}">
                            </div>
                        @endforeach
                    @else
                        <div id="carouselExampleInterval" class="carousel mb-3 mx-auto mw-100 slide carousel-dark order-details__image" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($order->images as $indexImage => $image)
                                    @if($indexImage == 0)
                                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{ $indexImage }}" class="active" aria-current="true"></button>
                                    @else
                                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{ $indexImage }}"></button>
                                    @endif
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach($order->images as $indexImage => $image)
                                    @if($indexImage == 0)
                                        <div class="carousel-item active" data-bs-interval="10000">
                                            <img src="{{ Storage::url($image->url) }}" class="d-block w-50 mx-auto" alt="{{$image->title}}">
                                        </div>
                                    @else
                                        <div class="carousel-item" data-bs-interval="2000">
                                            <img src="{{ Storage::url($image->url) }}" class="d-block w-50 mx-auto" alt="{{$image->title}}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                <span class="carousel-control-next-icon text-black-50" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                    <div class="order-details__information">
                        <h3 class="h3 mb-3 fw-bold">{{ $order->appellation }}</h3>
                        <div class="d-flex mt-2 mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Количество</p>
                            <p class="fs-6">{{ $order->count }}</p>
                        </div>
                        <div class="d-flex mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Где приобрести</p>
                            <a class="text-decoration-none fs-6 mb-0" href="{{ $order->product_link }}" target="_blank">{{ explode('/', $order->product_link)[2] }}</a>
                        </div>
                        <div class="d-flex mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Доставить из</p>
                            <p class="fs-6">{{ $order->delivery_from }}</p>
                        </div>
                        <div class="d-flex mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Доставить куда</p>
                            <p class="fs-6">{{ $order->where_to_deliver }}</p>
                        </div>
                        <div class="d-flex mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Доставить до</p>
                            <p class="fs-6">{{ Jenssegers\Date\Date::parse($order->deliver_to)->format('j F Y г.') }}</p>
                        </div>
                        @if($order['description'])
                            <div class="mb-2">
                                <p class="fs-6 fw-bold">Информация о товаре:</p>
                                <p class="fs-6 w-100 text-break">{{ $order->description }}</p>
                            </div>
                        @endif
                        @if($order['wishes'])
                            <div class="mb-2">
                                <p class="fs-6 fw-bold">Пожелания заказчика:</p>
                                <p class="fs-6 w-100 text-break">{{ $order->wishes }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="border-top border-3">
                        <div class="d-flex mt-2 mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Стоимость товара</p>
                            <p class="fs-6">{{ number_format($order->price, 2, '.', ' ') }} РУБ.</p>
                        </div>
                        <div class="d-flex mt-2 mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Вознаграждение</p>
                            <p class="fs-4 fw-bold">{{ number_format($order->award, 2, '.', ' ') }} РУБ.</p>
                        </div>
                        <div class="d-flex mt-2 mb-2 justify-content-between">
                            <p class="fs-6 fw-bold">Итого</p>
                            <p class="fs-4 fw-bold">{{ number_format(($order->price * $order->count) + $order->award, 2, '.', ' ') }} РУБ.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="orders_offer">
                <div class="order-details__body">
                    @if($order->order_status == 1)
                        <div class="p-3">
                            <p class="fs-4 mb-3 fw-bold">Статус доставки:</p>
                            <ul class="statuses">
                                <li class="statuses__status">
                                    <div class="time">{{ Jenssegers\Date\Date::parse($order->delivery->created_at)->format('j F Y г., в H:i')}}</div>
                                    <p class="fs-6 sw-bold">Начало</p>
                                </li>
                                @foreach($order->statuses as $status)
                                    <li class="statuses__status">
                                        <div class="time">{{ Jenssegers\Date\Date::parse($status->created_at)->format('j F Y г., в H:i')}}</div>
                                        <p class="fs-6 sw-bold">{{ $status->status }}</p>
                                        @if($status->message)
                                            <p class="fs-6">{{ $status->message }}</p>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <form method="POST" class="add-status-form" novalidate>
                                @csrf
                                @method('POST')
                                <div class="form-floating mb-3">
                            <textarea maxlength="400" class="form-control message offer_message"
                                      name="message" id="message" rows="5" style="resize: none; min-height: 100px;"
                                      placeholder="Сообщение покупателю (необязательно)"></textarea>
                                    <label for="message">Сообщение покупателю (необязательно)</label>
                                    <span class="invalid-feedback message_error">
                                        <strong></strong>
                                    </span>
                                    <p class="fs-6 offer_with_message">Напишите сообщение кратко, в 400 символах.</p>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="status" class="form-control status" id="status" placeholder="Укажите статус доставки">
                                    <label for="status">Укажите статус доставки</label>
                                    <span class="invalid-feedback status_error">
                                    <strong></strong>
                                </span>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100 btn-lg">Изменить статус доставки</button>
                                </div>
                            </form>
                            <script type="text/javascript">
                                // Реализация валидации пароля через fetch в модальном окне:
                                document.querySelector('.add-status-form').addEventListener('submit', function(event) {
                                    event.preventDefault();

                                    const formData = new FormData(this);

                                    fetch("{{ route('user.delivery.status', $order->id) }}", {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'Accept': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.errors) {
                                                Object.entries(data.errors).forEach(([key, value]) => {
                                                    document.querySelector(`.${key}_error strong`).textContent = value;
                                                    document.querySelector(`.${key}`).classList.add('is-invalid');
                                                });
                                            } else if (data.status) {
                                                location.reload();
                                            }
                                        })
                                        .catch(error => {
                                            console.log(error);
                                        });
                                });
                            </script>
                        </div>
                    @elseif($order->order_status == 2)
                        <p class="text-center fs-4 pt-3 pb-3">Заказ успешно доставлен.</p>

                        <p class="fs-4 fw-bold ps-3">Статус заказа:</p>
                        <ul class="statuses ps-3 pe-3 pb-3">
                            <li class="statuses__status">
                                <div class="time">{{ Jenssegers\Date\Date::parse($order->delivery->created_at)->format('j F Y г., в H:i')}}</div>
                                <p class="fs-6 sw-bold">Начало</p>
                            </li>
                            @foreach($order->statuses as $status)
                                <li class="statuses__status">
                                    <div class="time">{{ Jenssegers\Date\Date::parse($status->created_at)->format('j F Y г., в H:i')}}</div>
                                    <p class="fs-6 sw-bold">{{ $status->status }}</p>
                                    @if($status->message)
                                        <p class="fs-6">{{ $status->message }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
