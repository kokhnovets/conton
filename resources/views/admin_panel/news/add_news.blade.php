@extends('layouts.base')
@section('title', 'Добавить новость')
@section('main')
    <div class="container">
        <h2 class="h2 pt-5 pb-5 text-center">Добавление новости</h2>
        <form action="{{ route('admin.news.store') }}" class="news-form" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('POST')
            <div class="mb-3 input-news">
                <label class="btn btn-primary btn-lg w-100 @error('preview') btn-danger @enderror">
                    Загрузить превью<input type="file" name="preview" class="form-control input-news-image"
                                         id="preview" hidden>
                </label>
                @error('preview')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" placeholder="Укажите название новости">
                <label for="appellation">Укажите название новости</label>
                @error('title')
                <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="mb-3">
                <textarea class="w-100 @error('content') is-invalid @enderror" id="summernote" name="content">{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100 btn-lg">Добавить новость</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
