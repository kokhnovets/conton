<x-mail::message>
Здравствуйте,

{{ $offer->user->first_name }} {{ $offer->user->last_name }} предложил {{ $offer->offer }} РУБ. за доставку {{ $order->appellation }}
@if($offer->message)
    C сообщением: {{ $offer->message }}<br>
@endif

Вы можете просмотреть детали предложения, перейдя по ссылке:

<x-mail::button :url="route('user.orders.posted.detail', $order->id)">
    Перейти к заказу
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
