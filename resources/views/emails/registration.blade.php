<x-mail::message>
Gracias por registrarte en TimeSync.

Por favor, confirma tu registro haciendo clic en el siguiente botón:

<x-mail::button :url="{{$url}}">
    Confirmar registro
</x-mail::button>

Gracias,<br>
Equipo {{ config('app.name') }}.
</x-mail::message>
