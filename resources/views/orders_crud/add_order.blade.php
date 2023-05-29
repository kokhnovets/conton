@extends('layouts.base')
@section('title', 'Добавление заказа')
@section('main')
    <div class="order pb-5">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>{{ session('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h2 class="h2 pt-5 pb-5 text-center">Информация о заказе</h2>
            <form action="{{ route('order.validate.show') }}" class="order-form" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <input type="text" name="appellation" class="form-control @error('appellation') is-invalid @enderror" value="{{ old('appellation') }}" id="appellation" placeholder="Укажите название товара">
                    <label for="appellation">Укажите название товара</label>
                    @error('appellation')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="url" name="product_link" class="form-control @error('product_link') is-invalid @enderror" value="{{ old('product_link') }}" id="product_link" placeholder="Укажите ссылку на товар">
                    <label for="product_link">Укажите ссылку на товар</label>
                    @error('product_link')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" data-mask="currency" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" id="price" placeholder="Укажите цену на сайте">
                    <label for="price">Укажите цену на сайте</label>
                    @error('price')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Изображение товара</label>
                    <div class="d-flex order-file">
                        <label for="image" class="order__image-show order__fields input-file-order @error('image') is-invalid-image @enderror">
                            <input type="file" class="order__image-hide" name="image[]" id="image" accept="image/*" multiple value="{{ old('image') }}">
                            <p class="upload-text @error('image') is-invalid-image-text @enderror">Загрузить изображение</p>
                        </label>
                        <div class="input-image-order-list d-flex flex-wrap"></div>
                    </div>
                    @error('image')
                        <span class="invalid-feedback-image">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea contenteditable class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" style="resize: none; min-height: 100px;" placeholder="Опишите товар поподробнее: цвет, размер и так далее...">{{ old('description') }}</textarea>
                    <label for="description">Опишите товар поподробнее: цвет, размер и так далее...</label>
                    @error('description')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p class="fs-6 mt-2">Предоставьте как можно больше информации о товаре, чтобы путешественник купил именно то, что вы заказали.</p>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="count" class="form-control @error('count') is-invalid @enderror" value="{{ old('count', 1) }}" id="count" placeholder="Укажите количество товаров">
                    <label for="count">Укажите количество товаров</label>
                    @error('count')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea contenteditable class="form-control @error('wishes') is-invalid @enderror" name="wishes" id="wishes" rows="5" style="resize: none; min-height: 100px;" placeholder="Укажите пожелания перевозчику, если есть">{{ old('wishes') }}</textarea>
                    <label for="wishes">Укажите пожелания перевозчику, если есть</label>
                    @error('wishes')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('delivery_from') is-invalid @enderror" value="{{ old('delivery_from') }}" name="delivery_from" id="delivery_from" placeholder="Укажите, откуда доставить">
                    <label for="delivery_from">Укажите, откуда доставить</label>
                    @error('delivery_from')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('where_to_deliver') is-invalid @enderror" value="{{ old('where_to_deliver') }}" name="where_to_deliver" id="where_to_deliver" placeholder="Укажите, куда доставить">
                    <label for="where_to_deliver">Укажите, куда доставить</label>
                    @error('where_to_deliver')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="deliver_to" class="form-control @error('deliver_to') is-invalid @enderror" value="{{ old('deliver_to', (new DateTime())->modify('+2 weeks')->modify('+1 days')->format('Y-m-d')) }}" id="deliver_to">
                    <label for="deliver_to">До какого числа доставить</label>
                    @error('deliver_to')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" data-mask="currency" class="form-control @error('award') is-invalid @enderror" value="{{ old('award', 500) }}" name="award" id="award" placeholder="Укажите желаемое вознаграждение">
                    <label for="award">Укажите желаемое вознаграждение</label>
                    @error('award')
                    <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100 btn-lg">Далее</button>
                </div>
            </form>
        </div>
    </div>
@endsection
