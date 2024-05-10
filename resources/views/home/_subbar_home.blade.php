@php
    $user = auth()->user();
    //dd($user->roles->name);
@endphp

<div class="flex gap-10">

@include('layouts.button', ['url' => 'task.new', 'text' => '+ Nueva tarea'])

@if ($user->hasAnyRole(['timesync_admin', 'super_admin', 'admin']))
    @include('layouts.button', ['url' => 'service.new', 'text' => 'Nuevo servicio'])
@endif

@if ($user->hasAnyRole(['timesync_admin', 'super_admin']))
    {{-- @include('layouts.button', ['url' => 'user.new', 'text' => 'Nuevo usuario']) --}}
    @include('layouts.button', ['url' => 'users', 'text' => 'Trabajadores'])
@endif

@include('layouts.button', ['url' => 'task.new', 'text' => 'Lista de tareas'])

</div>