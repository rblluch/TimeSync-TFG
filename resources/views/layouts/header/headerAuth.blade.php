@extends('layouts.header.header')

@section('logo')
    {{ asset('storage/img/app/logo-timesync-blue.png') }}
@endsection

@php
    $user = auth()->user();
@endphp

@section('nav')
    <a href="{{route('index')}}" class="">Inicio</a>
    {{-- <a href="" class=""><img src="" alt="Iniciar Jornada"></a> --}}
    {{-- <a href="{{route('logout')}}" class="">Cerrar sesion</a> --}}
    @include('layouts.button', ['url' => 'logout', 'text' => 'Cerrar sesion', 'hover' => 'red'])

    @if ($user->is_working)
        @include('layouts.button', ['url' => 'workday', 'text' => 'Finalizar Jornada', 'color' => 'red'])
    @else
        @include('layouts.button', ['url' => 'workday', 'text' => 'Iniciar Jornada'])
    @endif
@endsection