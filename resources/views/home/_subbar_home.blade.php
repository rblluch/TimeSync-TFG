@php
    $user = auth()->user();
    //dd($user->roles->name);
@endphp

<div class="flex gap-10">

@include('layouts.button', ['url' => 'task.new', 'text' => '+ Nueva tarea'])

@if ($user->hasAnyRole(['timesync_admin', 'super_admin', 'admin']))
    @include('layouts.button', ['url' => 'task', 'text' => 'Nuevo servicio'])
@endif

@if ($user->hasAnyRole(['timesync_admin', 'super_admin']))
    @include('layouts.button', ['url' => 'task', 'text' => 'Nuevo usuario'])
@endif

</div>