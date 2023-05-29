<x-mail::message>
Здравствуйте,
<p>Ваш аккаунт забанен {{ Jenssegers\Date\Date::parse($user->banned_at)->format('j F Y г.')}}.</p><br>

<p>Причина бана: {{ $user->bans->first()->comment }}</p><br>
<p class="fs-6 mb-2">Тип бана:
    @if($user->bans->first()->expired_at)
        временный, до {{ Jenssegers\Date\Date::parse($user->bans->first()->expired_at)->format('j F Y г.')}}
    @else
        перманентный
    @endif
</p>


С уважением,<br>
{{ config('app.name') }}
</x-mail::message>

