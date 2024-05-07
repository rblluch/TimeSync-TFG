@extends('layouts.template')

@section('title', 'New Service - TimeSync')

@php
    $user = auth()->user();
@endphp

@section('content')
    <div class="w-full h-full flex items-center justify-center">

        <div class="form-card form-card-w-bg w-full max-w-sm p-4 border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" id="NOnewServiceForm" action="{{ route('service.store') }}" method="POST">
                {{-- <form class="space-y-6" id="loginForm" action="" method="POST"> --}}
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Crear nuevo Servicio</h5>
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
                        <label for="total_hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horas totales para el servicio</label>
                        <input type="number" name="total_hours" id="total_hours"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Horas" required value="{{ old('total_hours') }}"
                            @error('total_hours') style="border:2px solid red;" @enderror />
                    </div>
                </div>
                <button type="submit"
                    class="w-full text-neutral-700 hover:text-white bg-gray-200 hover:bg-neutral-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-200 dark:hover:bg-neutral-700 dark:focus:ring-blue-800">Crear Servicio</button>
            </form>
        </div>

    </div>
@endsection
