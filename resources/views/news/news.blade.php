@extends('layouts.base')
@section('desc', 'Здесь вы можете найти новости сервиса Conton, акции и розыгрыши!')
@section('title', 'Новости сервиса')
@section('main')
    <div class="container my-3">
        <h2 class="h2 text-center mb-3">Новости компании Conton</h2>
        @if(count($news))
            @foreach($news as $item)
                <div class="card-news">
                    <figure class="card__thumb">
                        <img src="{{ Storage::url($item->preview) }}" alt="{{ $item->title }}" class="card__image">
                        <figcaption class="card__caption">
                            <h2 class="card__title">{{ $item->title }}</h2>
                            <p class="card__snippet"></p>
                            <br>
                            <a href="{{ route('news.show', $item->id) }}" class="card__button">Читать</a>
                        </figcaption>
                    </figure>
                </div>
            @endforeach
        @else
            <h4 class="h4 text-center py-5">На данный момент пока нет новостей от компании</h4>
        @endif

    </div>
@endsection
