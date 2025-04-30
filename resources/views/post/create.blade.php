<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    <!-- Título -->
                    <div>
                        <x-input-label for="title" :value="__('Título do Post')" />
                        <x-text-input id="title" name="title" type="text" class="w-full mt-1" :value="old('title')"
                            placeholder="Digite um título impactante" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>


                    <!-- Conteúdo -->
                    <div>
                        <x-input-label for="content" :value="__('Conteúdo')" />
                        <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                        <trix-editor input="content"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary"></trix-editor>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>


                    <!-- Categoria -->
                    <div>
                        <x-input-label for="category_id" :value="__('Categoria')" />
                        <select id="category_id" name="category_id"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary"
                            required>
                            <option value="" disabled selected>Selecione uma categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }} class="">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Imagem -->
                    <div>
                        <x-input-label for="image" :value="__('Imagem de Destaque')" />
                        <input type="file" id="image" name="image"
                            class="block w-full mt-1 text-sm text-gray-600
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-medium
                                file:bg-primary/10 file:text-primary
                                hover:file:bg-primary/20"
                            accept="image/*">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Data de Publicação -->
                    <div>
                        <x-input-label for="published_at" :value="__('Data de Publicação')" />
                        <x-text-input id="published_at" name="published_at" type="datetime-local" class="w-full mt-1"
                            :value="old('published_at', now()->format('Y-m-d\TH:i'))" required />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <!-- Botão de Envio -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Publicar Artigo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <style>
            .trix-button-group--file-tools {
                display: none !important;
            }

            trix-editor {
                min-height: 300px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <script>
            document.addEventListener('trix-file-accept', function(event) {
                event.preventDefault();
                alert('Uploads de arquivos não são permitidos. Use links de imagens se desejar inserir uma imagem.');
            });
        </script>
    @endpush

</x-app-layout>
