@extends('layouts.template')

@section('title', 'New Task - TimeSync')

@section('content')
    <div class="bg-red-200 w-full h-full flex items-center justify-center">

        <div class="flex flex-col">
            <form action="" method="POST" class="flex flex-col">
                @csrf
                <input type="text" name="name" placeholder="Name" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <input type="number" name="service_id" placeholder="Service ID" required>
                <input type="number" name="worker_id" placeholder="Worker ID" required>
                <select name="status" required>
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
                <input type="date" name="scheduled_date" required>
                <button type="submit">Submit</button>
            </form>
        </div>


        <div
            class="form-card form-card-w-bg w-full max-w-sm p-4 border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" id="NOloginForm" action="{{ route('login') }}" method="POST">
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
                            @error('error') style="border:2px solid red;" @enderror />
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <input type="textfield" name="description" id="description" placeholder="descripción"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required @error('description') style="border:2px solid red;" @enderror />
                    </div>
                </div>
                <input type="number" name="company_id" value="{{auth()->user()->company->id}}" required disabled hidden>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear Tarea</button>
            </form>
        </div>

    </div>
@endsection
