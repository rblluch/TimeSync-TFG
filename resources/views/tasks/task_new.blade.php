@extends('layouts.template')

@section('title', 'New Task - TimeSync')

@php
    $user = auth()->user();
@endphp

@section('content')
    <div class="w-full h-full flex items-center justify-center">

        <div class="form-card form-card-w-bg w-full max-w-sm p-4 border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" id="NOnewTaskForm" action="{{ route('task.store') }}" method="POST">
                {{-- <form class="space-y-6" id="loginForm" action="" method="POST"> --}}
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Crear nueva tarea</h5>
                <div>
                    <div>
                        @error('error')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        {{-- <span id="error" style="color:red;" hidden > Credenciales incorrectas </span> --}}
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Nombre" required value="{{ old('name') }}"
                            @error('name') style="border:2px solid red;" @enderror />
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <input type="textfield" name="description" id="description" placeholder="descripción" value="{{ old('description') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required @error('description') style="border:2px solid red;" @enderror />
                    </div>
                </div>
                <div>
                    <div>
                        <label for="scheduled_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha prevista</label>
                        <input type="date" name="scheduled_date" id="scheduled_date" value="{{ date('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required @error('scheduled_date') style="border:2px solid red;" @enderror />
                    </div>
                    <div>
                        <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servicios</label>
                        <select name="service" id="service" name="service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required @error('service') style="border:2px solid red;" @enderror>
                            <option value="" disabled selected>Selecciona un servicio</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$user->hasRole('user'))
                        <div>
                            <label for="worker" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trabajador</label>
                            <select name="worker" id="worker" name="worker" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required @error('worker') style="border:2px solid red;" @enderror>
                                <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                @foreach ($workers as $worker)
                                    @if (!($worker->id == $user->id))
                                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="worker" value="{{$user->id}}">
                    @endif
                </div>
                <button type="submit"
                    class="w-full text-neutral-700 hover:text-white bg-gray-200 hover:bg-neutral-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-200 dark:hover:bg-neutral-700 dark:focus:ring-blue-800">Crear Tarea</button>
            </form>
        </div>

    </div>
@endsection
