<div class="flex justify-around items-center">
    <div>
        <img src="{{ asset('storage/img/app/logo-timesync-blue.png') }}" alt="TimeSync" class="w-48">
    </div>
    <div>
        <nav class="space-x-24">
            <a href="{{route('index')}}" class="">Inicio</a>
            <a href="" class="">Sobre nosotros</a>
            <a href="" class="">Contacto</a>
            @include('layouts.button', ['url' => 'register', 'text' => 'Unete ➜'])
        </nav>
    </div>
</div>

