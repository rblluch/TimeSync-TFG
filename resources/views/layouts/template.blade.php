<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('metadescription')">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('storage/css/app.css') }}">
</head>
<body class="h-svh bg-gray-200">
    @php
        $user = auth()->user();
    @endphp
    <div id="wrapper" class="flex flex-col min-h-screen">

        {{-- {{dd(asset('css/app.css'))}} --}}
        
        <header class="fixed w-full z-40 top-0 p-4">
            {{-- Check if user is authenticated --}}
            @if($user)
                @include('layouts.header.headerAuth')
            @else
                @include('layouts.header.headerGuest')
            @endif
        </header>

        <main class="flex-grow p-4 {{-- border-4 border-red-700 --}} grid">
            @yield('content')
        </main>

        <footer class="z-50 bg-neutral-800 text-white bottom-0 p-4">
            @include('layouts.footer')
        </footer>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../resources/js/config.js"></script>
    {!! NoCaptcha::renderJs() !!}
    @yield('scripts')
    <script src="../resources/js/header.js" ></script>

    {{-- <script src="{{ asset('jquery-3.7.1.min.js') }}"></script> --}}



</body>
</html>