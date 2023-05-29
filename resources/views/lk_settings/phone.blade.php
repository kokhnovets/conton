@extends('lk_settings.lk')

@section('setting')
    <form action="{{ route('user.update.phone', ['user' => $user->id]) }}" class="lk-form" method="post"
          enctype="multipart/form-data" novalidate>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>{{ session('message') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @csrf
        @method('PATCH')
        <h4 class="h4 mb-4 fw-bold">Номер телефона</h4>
        <div class="form-floating mb-3">
            <input type="text" data-mask="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   id="phone" placeholder="Номер телефона" value="{{ old('phone', $user->phone) }}">
            <label for="phone">Номер телефона</label>
            @error('phone')
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
