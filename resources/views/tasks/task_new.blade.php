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
                <input type="number" name="company_id" placeholder="Company ID" required>
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

                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">

                        </div>
                        <label for="remember"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recuérdame</label>
                    </div>
                    <a href="#" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost
                        Password?</a>
                </div>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                    to your account</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create
                        account</a>
                </div>
            </form>
        </div>

    </div>
@endsection
