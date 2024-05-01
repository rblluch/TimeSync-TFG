@extends('layouts.header.header')

@section('logo')
    {{ asset('storage/img/app/logo-timesync-blue.png') }}
@endsection

@section('nav')
    <a href="{{route('index')}}" class="">Inicio</a>
    <a href="" class="">Sobre nosotros</a>
    <a href="" class="">Contacto</a>
    @include('layouts.button', ['url' => 'register', 'text' => 'Unete ➜'])
@endsection