@extends('layouts.template')

@section('title', 'TimeSync')
@section('metadescription', 'TimeSync es una plataforma de sincronización de tiempo para empresas y organizaciones.')

@section('content')
    <div id="wrapper" class="wrapper-w-bg flex justify-around items-center {{-- border-solid border-4 border-black --}} p-5">

        <div>
            <h1
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-200 md:text-5xl lg:text-6xl dark:text-white">
                Sincroniza,<br>
                Simplifica,<br>
                TimeSync.
            </h1>
        </div>

        <div
            class="form-card form-card-w-bg w-full max-w-sm p-4 border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" id="NOloginForm" action="{{ route('login') }}" method="POST">
                {{-- <form class="space-y-6" id="loginForm" action="" method="POST"> --}}
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h5>
                <div>
                    @error('error')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    {{-- <span id="error" style="color:red;" hidden > Credenciales incorrectas </span> --}}
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="name@company.com" required value="{{ old('email') }}"
                        @error('error') style="border:2px solid red;" @enderror />
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required @error('error') style="border:2px solid red;" @enderror />
                </div>
                <div class="flex items-start">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            {{-- <input id="remember" type="checkbox" name="remember" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" /> --}}
                            
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" >

                        </div>
                        <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recuérdame</label>
                    </div>
                    <a href="#" class="ms-auto text-sm text-gray-200 hover:underline dark:text-gray-200">Contraseña perdida?</a>
                </div>
                <button type="submit"
                class="w-full text-neutral-700 hover:text-white bg-gray-200 hover:bg-neutral-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-200 dark:hover:bg-neutral-700 dark:focus:ring-blue-800">Login
                    to your account</button>
                <div class="text-sm font-medium text-neutral-700 dark:text-gray-300">
                    Not registered? <a href="{{route('register')}}" class="text-gray-200 hover:underline dark:text-gray-200">Create
                        account</a>
                </div>
            </form>
        </div>

    </div>


@endsection

@section('scripts')

    <script src="../resources/js/login.js"></script>

@endsection
