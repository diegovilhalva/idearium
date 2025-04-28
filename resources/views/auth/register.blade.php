<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h1 class="text-3xl font-serif font-bold text-secondary mb-8">Crie sua conta</h1>

        <!-- Name -->
        <div class="mb-6">
            <x-input-label for="name" :value="__('Name')" class="mb-2 text-gray-600" />
            <x-text-input 
                id="name" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="mb-2 text-gray-600" />
            <x-text-input 
                id="email" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" class="mb-2 text-gray-600" />
            <x-text-input 
                id="password" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary"
                type="password"
                name="password"
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-8">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-2 text-gray-600" />
            <x-text-input 
                id="password_confirmation" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full py-3 bg-primary font-serif hover:bg-[#156612] transition">
            {{ __('Create Account') }}
        </x-primary-button>

        <div class="mt-6 text-center text-gray-600">
            {{__('Already have an account?')}}
            <a href="{{ route('login') }}" class="text-primary font-serif hover:text-secondary transition">
                {{ __('Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>