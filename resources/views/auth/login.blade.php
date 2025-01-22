<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline py-4 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full py-4 justify-center text-lg font-medium text-black bg-gray-300 hover:bg-yellow-400 border border-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
            <span class="text-black">{{ __('Log in') }}</span>
        </x-primary-button>
        

        <!-- Heading with shadow lines -->
        <h2 class="relative text-center text-2xl font-semibold my-1 cursor-default">
            <span class="absolute left-0 top-1/2 w-2/5 h-[1px] bg-black transform -translate-y-1/2 shadow-md"></span>
            <span class="px-4">or</span>
            <span class="absolute right-0 top-1/2 w-2/5 h-[1px] bg-black transform -translate-y-1/2 shadow-md"></span>
        </h2>

        <!-- Phone login -->
        <div class="text-center mt-5">
            <a href="" class="w-full inline-flex items-center justify-center bg-white text-black border border-black rounded-md px-5 py-3 text-lg font-medium hover:bg-gray-200">
                <span class="text-xl mr-3 font-bold">📱</span>
                <span class="font-sans text-base">Login with Phone Number</span>
            </a>
        </div>

        <h2 class="relative text-center text-2xl font-semibold my-1 cursor-default">
            <span class="absolute left-0 top-1/2 w-2/5 h-[1px] bg-black transform -translate-y-1/2 shadow-md"></span>
            <span class="px-4">or</span>
            <span class="absolute right-0 top-1/2 w-2/5 h-[1px] bg-black transform -translate-y-1/2 shadow-md"></span>
        </h2>

        <!-- Google login -->
        <div class="text-center mt-5">
            <a href="{{route('auth.google')}}" class=" w-full inline-flex items-center justify-center bg-white text-black border border-black rounded-md px-5 py-3 text-lg font-medium hover:bg-gray-200">
                <span class="text-xl mr-3 font-bold">G</span>
                <span class="font-sans text-base">Login with Google</span>
            </a>
        </div>
        
    </form>
</x-guest-layout>
