<x-mail::message>
Здравствуйте,
Ваш аккаунт снят с бана.

Можете снова пользоваться нашим сервисом!

<x-mail::button :url="route('login')">
    Авторизация
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
