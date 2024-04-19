@extends('layouts.template')

@section('title', 'TimeSync')
@section('metadescription', 'TimeSync es una plataforma de sincronización de tiempo para empresas y organizaciones.')

@section('content')
    <div id="wrapper" class="flex-col justify-around items-center {{-- border-solid border-4 border-black --}} p-5">

        <div>
            <h2>Introduce tu correo electronico y recibiras un mensaje donde podras verificar tu cuenta e introducir la contraseña que se usara.</h2>
        </div>

        <div class="form-card form-card-w-bg w-full max-w-sm p-4 border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" id="registerForm" action="">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Primer paso para unirte a TimeSync</h5>
                <div>
                    <span id="error" style="color:red;" hidden > Correo invalido o ya en uso </span>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-Mail</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="name@company.com" required />
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirma tu E-Mail</label>
                    <input type="email" name="email-confirmation" id="email-confirmation" placeholder="name@company.com"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required />
                </div>
                {!! NoCaptcha::display() !!}
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Envia correo de confirmacion</button>
            </form>
        </div>

    </div>


@endsection

@section('scripts')

    <script src="../resources/js/access.js" ></script>

@endsection
