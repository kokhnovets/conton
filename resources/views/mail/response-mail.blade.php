<x-mail::message>
Здравствуйте

Служба поддержки ответила вам: <p style="font-weight:bold; color: #000000">{{ $message }}</p>
Статус вашей заявки: <p style="font-weight:bold; color: #000000">{{ $status }}</p>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
