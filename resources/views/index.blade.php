@extends('layouts.base')
@section('desc', 'Conton - сервис покупки и доставки товаров через путешественников.
Получите желаемые товары из любой точки мира быстро и удобно.')
@section('title', 'Главная')
@section('main')
    <div class="main-page">
        <div class="container">
            <section class="u-align-center u-clearfix u-section-3">
                <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
                    <div class="u-clearfix u-expanded-width u-gutter-30 u-layout-wrap u-layout-wrap-1">
                        <div class="u-layout">
                            <div class="u-layout-row">
                                <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-36 u-layout-cell-1">
                                    <div class="u-container-layout u-container-layout-1">
                                        <div class="u-container-style u-group u-image u-image-tiles u-image-1" data-image-width="300" data-image-height="300">
                                            <div class="u-container-layout u-container-layout-2"></div>
                                        </div>
                                        <div class="u-palette-4-base u-shape u-shape-1"></div>
                                        <img class="u-image u-image-2" src="{{ URL::asset('images/index/ghfghgf.webp') }}" data-image-width="800" data-image-height="526">
                                    </div>
                                </div>
                                <div class="u-align-left u-container-style u-layout-cell u-right-cell u-size-24 u-layout-cell-2">
                                    <div class="u-container-layout u-valign-middle u-container-layout-3">
                                        <h2 class="u-custom-font u-font-montserrat u-text u-text-default u-text-1">Путешествуй без границ. Покупай то, о чем мечтаешь.</h2>
                                        <p class="u-text u-text-2">Conton организовывает взаимодействие между покупателями и путешественниками, что позволяет обеспечить большую доступность в мире.</p>
                                        <div class="link__action d-flex mt-3">
                                            <a href="{{ route('order.add') }}" class="btn btn-outline-dark me-5 w-100">Сделать заказ</a>
                                            <a href="{{ route('travel') }}" class="btn btn-outline-dark w-100">Доставить заказ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="mt-5">
            <h2 class="text-center h2 fw-bold mb-5">Как работает Conton</h2>
            <div class="tabs container">
                <div class="tabs__nav">
                    <button class="tabs__btn tabs__btn_active h4">Покупателям</button>
                    <button class="tabs__btn h4">Путешественникам</button>
                </div>
                <div class="tabs__content">
                    <div class="tabs__pane tabs__pane_show">
                        <div class="tabs__title text-center mb-5">
                            <p class="fs-4 fw-bold">Conton - это простой способ приобрести товары, которые недоступны в вашей стране или стоят слишком дорого. На Conton вы можете заказать все от детской одежды до гаджетов и пищевых добавок.</p>
                        </div>
                        <div class="tabs__text">
                            <ul class="tabs__nav">
                                <li class="tabs_row-column">
                                    <div class="tabs_row-text">
                                        <div class="tabs_row-text-left">
                                            <p class="tabs_row-text-number">1</p>
                                        </div>
                                        <div class="tabs_row-text-right">
                                            <p class="tabs_row-text-title">Выберите, что хотите заказать</p>
                                            <p>С Conton вы можете заказать любую вещь со всего мира. Чтобы начать, выберите сначала заказ.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="tabs_row-column">
                                    <div class="tabs_row-text">
                                        <div class="tabs_row-text-left">
                                            <p class="tabs_row-text-number">2</p>
                                        </div>
                                        <div class="tabs_row-text-right">
                                            <p class="tabs_row-text-title">Создайте заказ: заполните необходимую информацию о товаре и опубликуйте его</p>
                                            <p>Создайте заказ и расскажите путешественнику, сколько стоит ваш товар и где его можно купить.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="tabs_row-column">
                                    <div class="tabs_row-text">
                                        <div class="tabs_row-text-left">
                                            <p class="tabs_row-text-number">3</p>
                                        </div>
                                        <div class="tabs_row-text-right">
                                            <p class="tabs_row-text-title">Выберите путешественника с наиболее подходящим предложением из всех предложений</p>
                                            <p>Выберите наиболее выгодное предложение от путешественника</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="tabs_row-column">
                                    <div class="tabs_row-text">
                                        <div class="tabs_row-text-left">
                                            <p class="tabs_row-text-number">4</p>
                                        </div>
                                        <div class="tabs_row-text-right">
                                            <p class="tabs_row-text-title">Встретьтесь с путешественником и получите свой заказ</p>
                                            <p>Договоритесь с путешественником о месте и времени для встречи, которое устроит вас обоих. Мы переведем оплату путешественнику, как только вы подтвердите получение заказа.</p>
                                        </div>
                                    </div>
                                </li>
                                <a class="btn btn-primary w-100 btn-lg" href="{{ route('order.add') }}">Сделать заказ</a>
                            </ul>
                        </div>
                    </div>
                    <div class="tabs__pane">
                        <div class="tabs__title text-center mb-5">
                            <p class="fs-4 fw-bold">Зарабатывайте в поездках с Conton. Наши путешественники в среднем зарабатывают до $300 за одну доставку. С Conton вы не только сможете получить вознаграждение, но и познакомиться с местными людьми по всему миру.</p>
                        </div>
                        <div class="tabs__text">
                            <ul class="tabs__nav">
                                <li class="tabs_row-text">
                                    <div class="tabs_row-text-left">
                                        <p class="tabs_row-text-number">1</p>
                                    </div>
                                    <div class="tabs_row-text-right">
                                        <p class="tabs_row-text-title">Выберите заказ и сделайте предложение о доставке</p>
                                        <p>Выберите подходящий заказ по вашему маршруту. Сделайте предложение о доставке и укажите вознаграждение - сумму, которую покупатель заплатит вам за доставку.</p>
                                    </div>
                                </li>
                                <li class="tabs_row-text">
                                    <div class="tabs_row-text-left">
                                        <p class="tabs_row-text-number">2</p>
                                    </div>
                                    <div class="tabs_row-text-right">
                                        <p class="tabs_row-text-title">Договоритесь о деталях заказа с покупателем</p>
                                        <p>Обсудите детали товара, его цвет и размер с покупателем во встроенном мессенджере. Попросите покупателя прислать ссылки на другие заказы.</p>
                                    </div>
                                </li>
                                <li class="tabs_row-text">
                                    <div class="tabs_row-text-left">
                                        <p class="tabs_row-text-number">3</p>
                                    </div>
                                    <div class="tabs_row-text-right">
                                        <p class="tabs_row-text-title">Купите товар за свои деньги</p>
                                        <p>Так вы будете знать, что везете в своем багаже. Когда покупатель подтвердит получение заказа, мы возместим средства на покупку товара и переведем вознаграждение путешественника.</p>
                                    </div>
                                </li>
                                <li class="tabs_row-text">
                                    <div class="tabs_row-text-left">
                                        <p class="tabs_row-text-number">4</p>
                                    </div>
                                    <div class="tabs_row-text-right">
                                        <p class="tabs_row-text-title">Доставьте заказ покупателю и получите вознаграждение</p>
                                        <p>Договоритесь с покупателем о месте и времени для встречи. Мы переведем вам оплату, когда покупатель подтвердит получение заказа</p>
                                    </div>
                                </li>
                                <a class="btn btn-primary w-100 btn-lg" href="{{ route('travel') }}">Доставить заказ</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 mt-5 container">
            <h2 class="text-center h2 fw-bold mb-5">Мы гордимся качеством наших услуг</h2>
            <p class="text-center fs-5">Это быстрый и надежный способ совершать покупки по всему миру и зарабатывать в путешествиях</p>
            <section class="u-align-center u-clearfix u-section-1" id="sec-c68c">
                <div class="u-clearfix u-sheet u-sheet-1">
                    <div class="u-expanded-width u-list u-list-1">
                        <div class="u-repeater u-repeater-1">
                            <div class="u-align-center u-container-style u-list-item u-repeater-item">
                                <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-custom-color-1 u-file-icon u-icon u-icon-circle u-text-white u-icon-1"><img src="{{ URl::asset('images/index/advantages/economy.webp') }}" alt="economy"></span>
                                    <h3 class="u-text u-text-3">Экономия на доставке</h3>
                                    <p class="u-text u-text-4">Путешественники берут товары с собой в путешествие, что позволяет сэкономить на стоимости доставки</p>
                                </div>
                            </div>
                            <div class="u-align-center u-container-style u-list-item u-repeater-item">
                                <div class="u-container-layout u-similar-container u-container-layout-2"><span class="u-custom-color-1 u-file-icon u-icon u-icon-circle u-text-white u-icon-2"><img src="{{ URl::asset('images/index/advantages/delivery.webp') }}" alt="delivery"></span>
                                    <h3 class="u-text u-text-5">Быстрая доставка</h3>
                                    <p class="u-text u-text-6">Товары доставляются в от недели до двух месяцев, что гораздо быстрее, чем обычная международная доставка</p>
                                </div>
                            </div>
                            <div class="u-align-center u-container-style u-list-item u-repeater-item">
                                <div class="u-container-layout u-similar-container u-container-layout-3"><span class="u-custom-color-1 u-file-icon u-icon u-icon-circle u-text-white u-icon-3"><img src="{{ URl::asset('images/index/advantages/safety.webp') }}" alt=""></span>
                                    <h3 class="u-text u-text-7">Безопасность</h3>
                                    <p class="u-text u-text-8">Товары доставляются напрямую в руки получателя, что позволяет избежать риска потери или повреждения товара во время транспортировки</p>
                                </div>
                            </div>
                            <div class="u-align-center u-container-style u-list-item u-repeater-item">
                                <div class="u-container-layout u-similar-container u-container-layout-4"><span class="u-custom-color-1 u-file-icon u-icon u-icon-circle u-text-white u-icon-4"><img src="{{ URl::asset('images/index/advantages/possibility.webp') }}" alt=""></span>
                                    <h3 class="u-text u-text-9">Возможность</h3>
                                    <p class="u-text u-text-10">С помощью сервиса можно приобрести товары, которые не продаются в вашей стране</p>
                                </div>
                            </div>
                            <div class="u-align-center u-container-style u-list-item u-repeater-item">
                                <div class="u-container-layout u-similar-container u-container-layout-5"><span class="u-custom-color-1 u-file-icon u-icon u-icon-circle u-text-white u-icon-5"><img src="{{ URl::asset('images/index/advantages/support.webp') }}" alt=""></span>
                                    <h3 class="u-text u-text-11">Служба поддержки 24/7</h3>
                                    <p class="u-text u-text-12">Наша преданная команда специалистов из службы поддержки поможет решить любые вопросы от создания заказа до его доставки</p>
                                </div>
                            </div>
                            <div class="u-align-center u-container-style u-list-item u-repeater-item">
                                <div class="u-container-layout u-similar-container u-container-layout-6"><span class="u-custom-color-1 u-file-icon u-icon u-icon-circle u-text-white u-icon-6"><img src="{{ URl::asset('images/index/advantages/eco.webp') }}" alt=""></span>
                                    <h3 class="u-text u-text-13">Экологичность</h3>
                                    <p class="u-text u-text-14">Использование сервиса позволяет сэкономить ресурсы на транспортировку товаров, что уменьшает вред для окружающей среде</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="mt-5 container">
            <h2 class="text-center h2 fw-bold mb-5">Последние доставленные заказы</h2>
            <p class="text-center fs-5">Путешественники доставили эти товары на другой конец мира. Быстро и надёжно.</p>
            <div class="album py-5">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                        @foreach($orders as $order)
                                <div class="col index-orders">
                                    <div class="card shadow-sm">
                                        <img src="{{ Storage::url($order->images->first()->url) }}" alt="{{ $order->appellation }}">
                                        <div class="card-body d-flex justify-content-between">
                                            <div class="d-flex flex-column align-items-center">
                                                <img class="deliveried__photo_profile_path object-fit-cover" src="{{ $order->user->photo_profile_path ? Storage::url($order->user->photo_profile_path) : URL::asset('images/lk/user.png') }}"  alt="">
                                                <p class="" style="margin-bottom: 4px;">{{ $order->user->first_name }}</p>
                                                <p class="" style="margin-bottom: 0;">{{ $order->delivery_from }}</p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-2x fa-plane"></i>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <img class="deliveried__photo_profile_path object-fit-cover" src="{{ $order->delivery->user->photo_profile_path ? Storage::url($order->delivery->user->photo_profile_path) : URL::asset('images/lk/user.png') }}"  alt="">
                                                <p class="" style="margin-bottom: 4px;">{{ $order->delivery->user->first_name }}</p>
                                                <p class="" style="margin-bottom: 0;">{{ $order->where_to_deliver }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="joining-the-community mt-5">
            <div class="joining-the-community__body">
                <h2 class="h2 mb-5 joining-the-community__title text-center fw-bold">Присоединяйтесь к нашему сообществу!</h2>
                <div class="joining-the-community__links d-flex justify-content-between w-50 flex-wrap">
                    <a class="btn btn-primary joining-the-community__link w-100 mb-2" href="{{ route('order.add') }}">Заказать через Conton</a>
                    <a class="btn btn-primary joining-the-community__link w-100 mb-2" href="{{ route('travel') }}">Доставить через Conton</a>
                </div>
            </div>
        </div>
    </div>
@endsection
