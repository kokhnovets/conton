@extends('lk_settings.lk')

@section('setting')
    <form action="{{ route('user.update.details', ['user' => $user->id]) }}" class="lk-form" method="post"
          enctype="multipart/form-data" novalidate>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>{{ session('message') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @csrf
        @method('PATCH')
        <h4 class="h4 mb-4 fw-bold">Детали аккаунта</h4>
        <div class="form-floating mb-3">
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                   placeholder="Адрес электронной почты" value="{{ old('email', $user->email) }}">
            <label for="email">Адрес электронной почты</label>
            @error('email')
            <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <h4 class="h4">Смена пароля</h4>
        <div class="show-hide__password">
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input placeholder="Пароль" id="current_password" type="password"
                           class="form-control @error('current_password') is-invalid @enderror rounded"
                           name="current_password" required autocomplete="current-password" spellcheck="false"
                           autocorrect="off" autocapitalize="off">
                    <label for="current_password">Текущий пароль</label>
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button id="toggle-password" tabindex="-1" type="button" class="toggle-password d-none">
                    </button>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input placeholder="Пароль" id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror rounded" name="password" required
                           autocomplete="new-password" spellcheck="false" autocorrect="off" autocapitalize="off">
                    <label for="password">Пароль</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button id="toggle-password" tabindex="-1" type="button" class="toggle-password d-none">
                    </button>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input placeholder="Подтвердите пароль" id="password-confirm" type="password"
                           class="form-control rounded" name="password_confirmation" required
                           autocomplete="new-password" spellcheck="false" autocorrect="off" autocapitalize="off">
                    <label for="password-confirm">Подтвердите пароль</label>
                    <button id="toggle-password" tabindex="-1" type="button" class="toggle-password d-none">
                    </button>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100 btn-lg">Сохранить</button>
        </div>
    </form>
    @if(!Auth::user()->isAdmin())
        <div class="mt-3 lk-delete">
            <h4 class="h4 mb-4 fw-bold">Удаление аккаунта</h4>
            @if($orderExists || $deliveryExists)
                <p class="w-80 fs-6 text-center text-muted mt-1">
                    На данный момент вы не можете удалить аккаунт, так как у вас есть активные заказы.
                </p>
            @else
                <button type="button" class="btn btn-danger w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Удалить аккаунт
                </button>
                <p class="w-80 fs-6 text-center text-muted mt-1">
                    Совершая это действие, вы удаляете свой аккаунт со всеми данными, восстановить его можно будет, связавшись с поддержкой, скоро разработаем функционал восстановлления аккаунта через электронный адрес.
                </p>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Удалить аккаунт</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="delete-form" novalidate method="POST">
                                    @csrf
                                    @method('POST')
                                    <p class="fs-6 fw-bold">Введите пароль для удаления аккаунта:</p>
                                    <div class="input-group mb-3">
                                        <div class="form-floating">
                                            <input placeholder="Пароль" id="delete_password" type="password"
                                                   class="form-control rounded delete_password_error-input" name="delete_password" required
                                                   autocomplete="new-password" spellcheck="false" autocorrect="off" autocapitalize="off">
                                            <label for="delete_password">Пароль</label>
                                            <button id="toggle-password" tabindex="-1" type="button" class="toggle-password d-none"></button>
                                            <span class="invalid-feedback delete_password_error" role="alert">
                                                <strong></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-danger">Удалить аккаунт</button>
                                    </div>
                                </form>
                                <script type="text/javascript">
                                    // Реализация валидации пароля через fetch в модальном окне:
                                    document.querySelector('.delete-form').addEventListener('submit', function(event) {
                                        event.preventDefault(); // Отмена встроенных событий
                                        const formData = new FormData(this); // Получение данных с форм

                                        fetch("{{ route('user.delete.account') }}", {
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
                                                } else if (data.redirect) {
                                                    // Если успех, то перенаправляем пользователя на страницу авторизации
                                                    window.location = data.redirect;
                                                }
                                            })
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
@endsection
