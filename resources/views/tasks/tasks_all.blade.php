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
                @foreach($tasks as $task)
                
                    @if(isset($editing) && $editing == $task->id)
                        <form action="{{route('task.update', ['id' => $task->id])}}" id="updateUse" method="POST">
                            @csrf
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input type="text" name="name" id="name" class="text-sm font-medium text-gray-900" value="{{ $task->name }}">
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" name="email" id="email" class="text-sm text-gray-500" value="{{ $task->email }}">
                                </td>
                                <td class="px-6 py-4">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"></input>
                                    <a href="{{route('users')}}">Cancelar</a>
                                </td>
                            </tr>
                        </form>

                    @else

                        <tr id="userRow{{ $task->id }}" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="text-sm font-medium text-gray-900">{{ $task->name }}</div>
                            </th>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $task->description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500"></div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('users', ['editing' => $task->id])}}" id="editUser" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                <a href="{{route('user.delete', ['id' => $task->id])}}" id="deleteUser" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
