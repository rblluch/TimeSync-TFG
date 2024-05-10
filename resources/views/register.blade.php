@extends('layouts.template')

@section('title', 'TimeSync')
@section('metadescription', 'TimeSync es una plataforma de sincronización de tiempo para empresas y organizaciones.')

@section('content')
    <div id="wrapper" class="flex justify-around items-center {{-- border-solid border-4 border-black --}} p-5">

        <div id="instructions" class="text-center">
            <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Únete a Timesync</h1>
            <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                <ol>
                    <li><strong>Registra tu empresa</strong></li>
                    <li>Recibe un correo de confirmación</li>
                    <li>Introduce tu contraseña</li>
                    <li>¡Listo! Ya puedes empezar a usar TimeSync</li>
                </ol>
            </p>
            <a href="#" id="prueba"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Learn more
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>


        <div id="form-card-register"
            class="form-card form-card-w-bg w-full max-w-sm p-4 border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" id="NoregisterForm" action="{{route('register')}}" method="POST">
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Primer paso para unirte a TimeSync</h5>
                <div>
                    <span id="error" style="color:red;" hidden> Correo invalido o ya en uso </span>
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la
                        empresa</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="TimeSync" value="{{old('name')}}" required @error('name') style="border: 2px solid red" @enderror />
                </div>
                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-Mail</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="name@company.com" value="{{old('email')}}" required @error('email') style="border: 2px solid red" @enderror />
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required @error('password') style="border: 2px solid red" @enderror />
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repetir Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required @error('password_confirmation') style="border: 2px solid red" @enderror />
                </div>
                {!! NoCaptcha::display() !!}
                <button type="submit"
                class="w-full text-neutral-700 hover:text-white bg-gray-200 hover:bg-neutral-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-200 dark:hover:bg-neutral-700 dark:focus:ring-blue-800">Crear usuario</button>
            </form>
        </div>

        <div id="success-container" style="display: none;"></div>

    </div>


@endsection

@section('scripts')

    <script src="../resources/js/register.js"></script>

@endsection
