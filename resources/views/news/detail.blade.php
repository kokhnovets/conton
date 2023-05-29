@extends('layouts.base')
@section('desc', 'розыгрыш')
@section('title', $news->title)
@section('main')
    <div class="container my-3">
        <div class="mb-3 w-50 mx-auto">
            <img class="img-fluid" src="{{ Storage::url($news->preview) }}" alt="{{ $news->title }}">
        </div>
        <h2 class="h2 text-center mb-3">{{ $news->title }}</h2>
        {!! htmlspecialchars_decode($news->content) !!}
    </div>
@endsection
