<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>


    <div class="flex items-center space-x-6">
        <!-- Profile Image -->
        <div>
            @if($user->profile_image)
                <img 
                    src="{{ asset('storage/profile_images/' . $user->profile_image) }}" 
                    alt="{{ $user->name }}" 
                    
                >
            @else
                <img 
                    src="{{ asset('images/default-profile.png') }}" 
                    alt="Default Profile" 
                    
                >
            @endif
        </div>

        <!-- User Details -->
        <div>
            <h1 class="text-xl font-bold">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
        </div>
    </div>


</x-app-layout>
