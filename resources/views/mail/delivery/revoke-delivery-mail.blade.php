<x-mail::message>
Здравствуйте,
{{ $order->user->first_name }} {{ $order->user->last_name }} отменил доставку товара {{ $order->appellation }}
Вы можете просмотреть детали, перейдя по ссылке:

<x-mail::button :url="route('order.show', $order->id)">
    Перейти к заказу
</x-mail::button>


С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
