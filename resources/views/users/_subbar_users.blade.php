@php
    $user = auth()->user();
    //dd($user->roles->name);
@endphp

<div class="flex gap-10">

@if ($user->hasAnyRole(['timesync_admin', 'super_admin']))
    @include('layouts.button', ['url' => 'user.new', 'text' => 'Nuevo usuario'])
@endif

</div>