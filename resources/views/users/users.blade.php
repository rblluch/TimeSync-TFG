@extends('layouts.template')

@section('title', 'Usuarios - TimeSync')

@php
    use App\Models\Schedule;
@endphp

@section('content')

<div class="flex flex-col items-center home-wrapper">

    <nav class="fixed top-24 bg-gray-200 h-32 w-3/4 flex items-center mb-38 z-50">
        @include('users._subbar_users')
    </nav>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-56">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Correo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rol
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ¿Trabajando?
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ult finalizacion de jornada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                
                    @if(isset($editing) && $editing == $user->id)
                        <form action="{{route('user.update', ['id' => $user->id])}}" id="updateUse" method="POST">
                            @csrf
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input type="text" name="name" id="name" class="text-sm font-medium text-gray-900" value="{{ $user->name }}">
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" name="email" id="email" class="text-sm text-gray-500" value="{{ $user->email }}">
                                </td>
                                <td class="px-6 py-4">
                                    <select name="role" id="role" class="text-sm text-gray-500">
                                        @foreach($roles as $role)
                                            @if($user->roles->id == 1)
                                                <option value="{{ $role->id }}" {{ $role->id == $user->roles->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @else
                                                @if($role->id != 1)
                                                    <option value="{{ $role->id }}" {{ $role->id == $user->roles->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">{{ $user->is_working ? 'Si' : 'No' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">{{ optional($user->getLastSchedule())->end_time }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"></input>
                                    <a href="{{route('users')}}">Cancelar</a>
                                </td>
                            </tr>
                        </form>

                    @else

                        <tr id="userRow{{ $user->id }}" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </th>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $user->roles->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $user->is_working ? 'Si' : 'No' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ optional($user->getLastSchedule())->end_time }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('users', ['editing' => $user->id])}}" id="editUser" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                <a href="{{route('user.delete', ['id' => $user->id])}}" id="deleteUser" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
