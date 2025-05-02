<section class="max-w-3xl mx-auto">
    <header class="pb-6 border-b border-gray-200">
        <h2 class="text-2xl font-serif font-bold text-secondary">
            {{ __('Informações do Perfil') }}
        </h2>
        <p class="mt-2 text-gray-600">
            {{ __("Atualize suas informações pessoais e endereço de e-mail.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-8 space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nome --}}
            <div>
                <x-input-label for="name" :value="__('Nome Completo')" class="mb-2" />
                <x-text-input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary" 
                    :value="old('name', $user->name)" 
                    required 
                    autofocus 
                />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Username --}}
            <div>
                <x-input-label for="username" :value="__('Nome de Usuário')" class="mb-2" />
                <x-text-input 
                    id="username" 
                    name="username" 
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary" 
                    :value="old('username', $user->username)" 
                    required 
                />
                <p class="mt-2 text-sm text-gray-500">Exemplo: seu.nome</p>
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>
        </div>

        {{-- Email --}}
        <div class="space-y-4">
            <x-input-label for="email" :value="__('Endereço de Email')" class="mb-2" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary" 
                :value="old('email', $user->email)" 
                required 
            />
            
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100 mt-4">
                    <p class="text-sm text-yellow-700">
                        {{ __('Seu e-mail não está verificado.') }}
                        <button form="send-verification" class="ml-1 font-medium text-primary hover:text-secondary underline">
                            {{ __('Clique para reenviar o e-mail de verificação') }}
                        </button>
                    </p>
                </div>
            @endif

            @if (session('status') === 'verification-link-sent')
                <div class="p-4 bg-green-50 rounded-lg border border-green-100 mt-4">
                    <p class="text-sm text-green-700">
                        {{ __('Um novo link de verificação foi enviado para seu e-mail.') }}
                    </p>
                </div>
            @endif
            
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Imagem do Perfil --}}
        <div class="space-y-4">
            <x-input-label :value="__('Foto do Perfil')" class="mb-2" />
            
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <div class="w-24 h-24 rounded-full border-2 border-white shadow-lg overflow-hidden">
                        <img 
                            src="{{ $user->image ?: 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=1a8917&background=e5f5e8' }}" 
                            alt="Foto atual" 
                            class="w-12 h-12 object-cover"
                        >
                    </div>
                    <div class="absolute inset-0 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white text-sm">Alterar</span>
                    </div>
                </div>
                
                <label class="flex-1">
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        accept="image/*" 
                        class="hidden"
                        onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"
                    >
                    <div class="cursor-pointer px-4 py-2 border border-dashed border-gray-300 rounded-lg hover:border-primary transition-colors text-center">
                        <span class="text-primary">Escolher arquivo</span>
                        <span class="text-gray-500 ml-2">ou arraste aqui</span>
                    </div>
                </label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        {{-- Bio --}}
        <div class="space-y-4">
            <x-input-label for="bio" :value="__('Biografia')" class="mb-2" />
            <textarea 
                id="bio" 
                name="bio" 
                rows="4" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary resize-none"
                placeholder="Conte um pouco sobre você..."
            >{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- Botões --}}
        <div class="pt-6 border-t border-gray-200">
            <div class="flex items-center justify-end gap-4">
                <x-primary-button class="px-8 py-3 ">
                    {{ __('Salvar Alterações') }}
                </x-primary-button>

                @if (session('status') === 'profile-updated')
                    <div 
                        x-data="{ show: true }" 
                        x-show="show" 
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="flex items-center gap-2 text-green-600"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ __('Salvo com sucesso!') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </form>
</section>