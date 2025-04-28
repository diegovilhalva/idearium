<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="text-3xl font-serif font-bold text-secondary mb-8">Fazer Login</h1>

        
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="mb-2 text-gray-600" />
            <x-text-input 
                id="email" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

   
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" class="mb-2 text-gray-600" />
            <x-text-input 
                id="password" 
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-8">
            <label for="remember_me" class="flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-primary focus:ring-primary" 
                    name="remember"
                >
                <span class="ms-2 text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a 
                    class="text-primary hover:text-secondary transition" 
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full py-3 bg-primary font-serif hover:bg-[#156612] transition">
            {{ __('Log in') }}
        </x-primary-button>

        <div class="mt-6 text-center text-gray-600 font-serif">
            {{__("Don't have an account?")}} 
            <a href="{{ route('register') }}" class="text-primary hover:text-secondary transition">
                {{ __('Sign up')}}
            </a>
        </div>
    </form>
</x-guest-layout>
