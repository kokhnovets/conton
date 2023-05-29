<x-mail::message>
Здравствуйте,

{{ $order->user->first_name }} {{ $order->user->last_name }} принял ваше предложение за доставку товара {{ $order->appellation }}
Вы можете просмотреть детали заказа, перейдя по ссылке:

<x-mail::button :url="route('user.trips.active.detail', $order->id)">
    Перейти к заказу
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
