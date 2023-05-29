<x-mail::message>
Здравствуйте,

По вашему заказу обновлен статус доставки:
{{ $status->status }}<br>
@if($status->message)
    с сообщением {{ $status->message }}<br>
@endif
    Вы можете просмотреть детали доставки, перейдя по ссылке:
<x-mail::button :url="route('user.orders.active.detail', $order->id)">
    Перейти к заказу
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
