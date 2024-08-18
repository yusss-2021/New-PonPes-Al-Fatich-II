@extends('auth::layouts.master', ['title' => 'Sign Up'])
@section('content')
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto  pt:mt-0 dark:bg-gray-900">
        <a href="{{ route('auth.create') }}"
            class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            {{-- <img src="/images/logo.svg" class="mr-4 h-11" alt="FlowBite Logo"> --}}
            <span>{{ config('app.name') }}</span>
        </a>
        @session('success')
            <x-auth::alert type="success" message="{{ session('success') }}" />
        @endsession
        @session('error')
            <x-auth::alert type="danger" message="{{ session('error') }}" />
        @endsession
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Pendaftaran Akun {{ config('app.name') }}
            </h2>
            <form class="mt-8 space-y-6" method="post" action="{{ route('auth.store') }}">
                @csrf
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Anda</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nama Lengkap" required>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                        Anda</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="name@email.com" required>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password
                        Anda</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                    @error('passoword')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="confirm-password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password
                        Anda</label>
                    <input type="password" name="confirm_password" id="confirm-password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                    @error('confirm_password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                            class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                            required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">I accept the <a
                                href="#" class="text-primary-700 hover:underline dark:text-primary-500">Terms and
                                Conditions</a></label>
                    </div>
                </div>
                <button type="submit"
                    class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                    Up</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Already have an account? <a href="{{ route('auth.index') }}"
                        class="text-primary-700 hover:underline dark:text-primary-500">Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
