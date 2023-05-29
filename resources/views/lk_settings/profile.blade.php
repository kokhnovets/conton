@extends('lk_settings.lk')

@section('setting')
    <form action="{{ route('user.update.profile', ['user' => $user->id]) }}" class="lk-form" method="post"
          enctype="multipart/form-data" novalidate>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>{{ session('message') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @csrf
        @method('PATCH')
        <h4 class="h4 mb-4 fw-bold">Настройки профиля</h4>
        <div class="mb-3">
            <img src="{{ $user->photo_profile_path ? Storage::url($user->photo_profile_path) : URL::asset('images/lk/user.webp') }}"
                 alt="photo_profile" class="lk-avatar object-fit-cover">
            <label class="btn btn-primary btn-lg w-100">
                Загрузить фото<input type="file" name="photo_profile_path" class="form-control input-image"
                                     id="photo_profile_path" hidden>
            </label>
            @error('photo_profile_path')
            <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <h5 class="h5">Личная информация</h5>
        <div class="form-floating mb-3">
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                   id="first_name" placeholder="Имя" value="{{ old('first_name', $user->first_name) }}">
            <label for="first_name">Имя</label>
            @error('first_name')
            <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                   id="last_name" placeholder="Фамилия" value="{{ old('last_name', $user->last_name) }}">
            <label for="last_name">Фамилия</label>
            @error('last_name')
            <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea maxlength="400" class="form-control about_me @error('about_me') is-invalid @enderror"
                      name="about_me" id="about_me" rows="5" style="resize: none; min-height: 100px;"
                      placeholder="О себе">{{ old('about_me', $user->about_me) }}</textarea>
            <label for="about_me">О себе</label>
            @error('about_me')
            <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <p class="fs-6 about_me_message">Расскажите о себе в 400 символах.</p>
        </div>
            <h5 class="h5">Маршрут</h5>
            <div class="form-floating mb-3">
                <input type="text" name="where_from" class="form-control @error('where_from') is-invalid @enderror"
                       id="where_from" placeholder="Откуда" value="{{ old('where_from', $user->where_from) }}">
                <label for="where_from">Откуда</label>
                @error('where_from')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="where" class="form-control @error('where') is-invalid @enderror" id="where"
                       placeholder="Куда" value="{{ old('where', $user->where) }}">
                <label for="where">Куда</label>
                @error('where')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100 btn-lg">Сохранить</button>
        </div>
    </form>
@endsection
