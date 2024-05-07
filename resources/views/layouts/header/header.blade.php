<div class="flex justify-around items-center bg-gray-200 h-20 p-12">
    <div>
        <a href="{{route('home')}}"><img src="@yield('logo')" alt="TimeSync" class="@yield('logo-class')"></a>
    </div>
    <div>
        <nav class="space-x-24">
            @yield('nav')
        </nav>
    </div>
</div>
