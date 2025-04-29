<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Categorias -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-serif font-bold text-secondary mb-4">Explore por Categorias</h2>
                    
                        <x-category-list/>
                    
                </div>
            </div>

            <!-- Posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <x-post-item :post="$post"></x-post-item>
                @endforeach
            </div>
            @if (count($posts) === 0)
                <div class="flex items-center justify-center">
                    <div class="text-center space-y-4 mt-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h2l2 2h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-2xl font-serif font-bold text-secondary">Nenhum post encontrado</h3>
                        <p class="text-gray-600 max-w-md">
                            Nossos escritores estão preparando novos conteúdos incríveis.<br>
                            Volte em breve para explorar novos artigos!
                        </p>
                    </div>
                </div>
            @endif

            <!-- Paginação -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>