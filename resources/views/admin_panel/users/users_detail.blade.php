@extends('layouts.base')
@section('title', 'Пользователь ' . $user->first_name . ' ' . $user->last_name)
@section('main')
    <div class="home">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex flex-wrap-reverse justify-content-center justify-content-lg-between w-75">
                    <div>
                        <h4 class="h4 fw-bold mb-4">{{ $user->first_name }} {{ $user->last_name }}</h4>
                        <p class="fs-5 mb-3">В сообществе с {{ Jenssegers\Date\Date::parse($user->created_at)->format('j F Y г.')}}</p>
                        <p class="fs-5 mb-3">Электронный адрес: {{ $user->email }}</p>
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
                        <div class="mb-2 w-100">
                            @if($user->banned_at && !$user->deleted_at)
                                <form action="{{ route('admin.users.unbanned', $user->id) }}" method="POST" >
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-100 btn btn-primary">Разбанить пользователя</button>
                                </form>
                            @elseif(!$user->banned_at && !$user->deleted_at)
                                <button type="button" class="w-100 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Забанить пользователя
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Забанить пользователя</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-banned-user" method="POST" novalidate>
                                                    @csrf
                                                    @method('PATCH')
                                                    <p class="fs-6 fw-bold mb-3">Введите причину бана:</p>
                                                    <div class="form-floating mb-3">
                                                    <textarea maxlength="400" class="form-control reason_for_ban_error-input"
                                                              name="reason_for_ban" id="reason_for_ban" rows="5" style="resize: none; min-height: 100px;"
                                                              placeholder="Причина бана"></textarea>
                                                        <label for="reason_for_ban">Причина бана</label>
                                                        <span class="invalid-feedback reason_for_ban_error">
                                                        <strong></strong>
                                                    </span>
                                                        <p class="fs-6">Напишите причину бана кратко, до 400 символов.</p>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <select class="form-control selected_ban" name="selected_ban" id="selected_ban">
                                                            <option value="0" selected>Перманентный бан</option>
                                                            <option value="1">Временный бан</option>
                                                        </select>
                                                        <label for="reason_for_ban">Выберите тип бана</label>
                                                    </div>
                                                    <div class="form-floating ban_date-input" hidden>
                                                        <input placeholder="До какого числа бан?" id="ban_date" type="date"
                                                               class="form-control ban_date_error-input" name="ban_date">
                                                        <label for="ban_date">До какого числа бан?</label>
                                                        <span class="invalid-feedback ban_date_error" role="alert">
                                                            <strong></strong>
                                                        </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn user-banned btn-danger">Забанить</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <script type="text/javascript">
                                                const ban_date = document.querySelector('.ban_date-input');
                                                const selected_ban = document.querySelector('.selected_ban');
                                                selected_ban.addEventListener('input', function (e) {
                                                    if (+e.target.value === 0) {
                                                        ban_date.hidden = true;
                                                        document.querySelector(`.ban_date_error strong`).textContent = '';
                                                        document.querySelector(`.ban_date_error-input`).classList.remove('is-invalid');
                                                    } else if(+e.target.value === 1) {
                                                        ban_date.hidden = false;
                                                    }
                                                });
                                                // Реализация валидации пароля через fetch в модальном окне:
                                                document.querySelector('.form-banned-user').addEventListener('submit', function(event) {
                                                    event.preventDefault(); // Отмена встроенных событий
                                                    const formData = new FormData(this); // Получение данных с форм
                                                    if (!ban_date.hidden) {
                                                        if (!ban_date.children[0].value) {
                                                            document.querySelector(`.ban_date_error strong`).textContent = 'Выберите дату разбана';
                                                            document.querySelector(`.ban_date_error-input`).classList.add('is-invalid');
                                                        } else {
                                                            fetch("{{ route('admin.users.banned', $user->id) }}", {
                                                                method: 'POST', // Метод
                                                                body: formData, // Данные
                                                                headers: { // Тип
                                                                    'Accept': 'application/json',
                                                                    'X-Requested-With': 'XMLHttpRequest'
                                                                }
                                                            })
                                                                .then(response => response.json()) // Получение данных
                                                                .then(data => {
                                                                    if (data.errors) { // Если валидация не прошла, отображаем ошибки
                                                                        Object.entries(data.errors).forEach(([key, value]) => {
                                                                            document.querySelector(`.${key}_error strong`).textContent = value;
                                                                            document.querySelector(`.${key}_error-input`).classList.add('is-invalid');
                                                                        });
                                                                    } else if (data.status) {
                                                                        // Если успех, то обновляем страницу
                                                                        location.reload();
                                                                    }
                                                                })
                                                        }
                                                    } else {
                                                        fetch("{{ route('admin.users.banned', $user->id) }}", {
                                                            method: 'POST', // Метод
                                                            body: formData, // Данные
                                                            headers: { // Тип
                                                                'Accept': 'application/json',
                                                                'X-Requested-With': 'XMLHttpRequest'
                                                            }
                                                        })
                                                            .then(response => response.json()) // Получение данных
                                                            .then(data => {
                                                                if (data.errors) { // Если валидация не прошла, отображаем ошибки
                                                                    Object.entries(data.errors).forEach(([key, value]) => {
                                                                        document.querySelector(`.${key}_error strong`).textContent = value;
                                                                        document.querySelector(`.${key}_error-input`).classList.add('is-invalid');
                                                                    });
                                                                } else if (data.status) {
                                                                    // Если успех, то обновляем страницу
                                                                    location.reload();
                                                                }
                                                            })
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="w-100">
                            @if($user->deleted_at)
                                <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" >
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-100 btn btn-primary">Восстановить аккаунт</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @if($user->banned_at)
                    <div class="mb-3 d-flex w-75">
                        <div>
                            <p class="fs-6 mb-2">Забанен: <span class="fw-bold">{{ Jenssegers\Date\Date::parse($user->banned_at)->format('j F Y г.')}}</span></p>
                            @foreach($user->bans as $index => $ban)
                                <p class="fs-6 mb-2">Причина бана: <span class="fw-bold">{{ $ban->comment }}</span></p>
                                <p class="fs-6 mb-2">Кем забанен: <span class="fw-bold">{{ \App\Models\User::where('id', $ban->created_by_id)->first()->first_name }} {{ \App\Models\User::where('id', $ban->created_by_id)->first()->last_name }}</span></p>
                                <p class="fs-6 mb-2">Тип бана:
                                @if($ban->expired_at)
                                    временный, до <span class="fw-bold">{{ Jenssegers\Date\Date::parse($ban->expired_at)->format('j F Y г.')}}</span>
                                @else
                                    <span class="fw-bold">перманентный</span>
                                @endif
                                </p>
                            @endforeach
                        </div>
                        <div></div>
                    </div>
                @endif
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
                <ul class="d-flex justify-content-around mt-4 w-75">
                    <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('admin.users.detail', $user->id) ? 'user-orders__active pb-2' : null }} {{ request()->routeIs('admin.users.detail.orders') ? 'user-orders__active pb-2' : null }}" href="{{ route('admin.users.detail.orders', $user->id) }}">Заказы пользователя</a></li>
                    <li><a class="text-decoration-none fs-6 text-dark d-block {{ request()->routeIs('admin.users.detail.deliveries') ? 'user-orders__active pb-2' : null }}" href="{{ route('admin.users.detail.deliveries', $user->id) }}">Доставки пользователя</a></li>
                </ul>
                @yield('orders_and_deliveries')
            </div>
        </div>
    </div>
@endsection
