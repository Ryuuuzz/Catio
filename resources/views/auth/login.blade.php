<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-blue-100" 
                            type="email" name="email" 
                            :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full bg-blue-100" 
                            type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                        class="rounded border-gray-300 shadow-sm focus:ring-indigo-500" 
                        name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Forgot Password, Register Link, and Login Button -->
        <div class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-4 sm:space-y-0 sm:space-x-4">
            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Don't Have an Account? -->
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                    href="{{ route('register') }}">
                    {{ __("Don't have an account?") }}
                </a>
            @endif

            <!-- Login Button -->
            <button class="bg-blue-800  hover:bg-blue-900 transition transform hover:scale-105 rounded-md px-4 py-2 text-white">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
