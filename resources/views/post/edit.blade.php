<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-6">Editar Post</h1>
        <form action="{{ route('post.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="title" :value="__('Título do Post')" />
                <input type="text"  name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary placeholder-gray-400 transition-colors duration-200 disabled:bg-gray-50 disabled:cursor-not-allowed" required>
            </div>

            <div class="mb-4">
                <x-input-label for="content" :value="__('Conteúdo')" />
                <input id="content" type="hidden" name="content" value="{{ old('content', $post->content) }}">
                <trix-editor input="content" class=" border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-primary"></trix-editor>
            </div>
            

            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">Atualizar</button>
        </form>
    </div>
</x-app-layout>
