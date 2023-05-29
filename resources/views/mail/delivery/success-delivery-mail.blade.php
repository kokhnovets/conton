<x-mail::message>
Здравствуйте,

{{ $order->user->first_name }} {{ $order->user->last_name }} подтвердил доставку товара {{ $order->appellation }}
Вы можете просмотреть детали заказа, перейдя по ссылке:

<x-mail::button :url="route('user.trips.completed.detail', $order->id)">
    Перейти к заказу
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
