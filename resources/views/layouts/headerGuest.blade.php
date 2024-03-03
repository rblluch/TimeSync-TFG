
<div class="flex justify-around items-center">
    <div>
        <img src="{{asset('storage/img/app/logo-timesync-lightgray.png')}}" alt="TimeSync" class="w-48">
    </div>
    <div>
        <nav class="space-x-24">
            <a href="" class="">Home</a>
            <a href="" class="">About us</a>
            <a href="" class="">Contact</a>
            @include('layouts.button', ['url' => 'signup', 'text' => 'Sign Up ➜'])
        </nav>
    </div>
</div>