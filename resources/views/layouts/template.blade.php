<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('storage/css/app.css') }}">
</head>
<body class="h-svh bg-gray-200">
    <div id="wrapper" class="flex flex-col min-h-screen">

        {{-- {{dd(asset('css/app.css'))}} --}}
        
        <header class="sticky z-50 top-0 p-4">
            {{-- Check if user is authenticated --}}
            @if(auth()->user())
                @include('layouts.headerAuth')
            @else
                @include('layouts.headerGuest')
            @endif
        </header>

        <main class="flex-grow p-4 {{-- border-4 border-red-700 --}} grid">
            @yield('content')
        </main>

        <footer class="z-50 bg-neutral-800 text-white bottom-0 p-4">
            @include('layouts.footer')
        </footer>
        
    </div>
</body>
</html>