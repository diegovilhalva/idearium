<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Categorias -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-serif font-bold text-secondary mb-4">Explore por Categorias</h2>
                    <ul class="flex flex-wrap gap-3">
                        @foreach ($categories as $category)
                        <li>
                            <a href="#" 
                               class="inline-block px-4 py-2 text-primary bg-primary/10 hover:bg-primary/20 rounded-full transition-colors duration-200 border border-primary/20">
                                {{ $category->name }}
                              
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <article class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow duration-200">
                    <a href="{{ route('posts.show', $post->slug) }}" class="block">
                        @if($post->image)
                        <img class="w-full h-48 object-cover" 
                             src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}">
                        @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400">Sem imagem</span>
                        </div>
                        @endif
                    </a>
                    
                    <div class="p-6">
                        <div class="mb-3 flex items-center justify-between">
                            <a href="{{ route('categories.show', $post->category->slug) }}" 
                               class="text-sm text-primary hover:text-secondary transition-colors">
                                {{ $post->category->name }}
                            </a>
                            <time datetime="{{ $post->published_at->toDateString() }}" 
                                  class="text-sm text-gray-500">
                                {{ $post->published_at->translatedFormat('d M Y') }}
                            </time>
                        </div>
                        
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <h3 class="text-xl font-serif font-bold text-secondary mb-2 leading-tight">
                                {{ $post->title }}
                            </h3>
                        </a>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               class="inline-flex items-center text-primary hover:text-secondary transition-colors">
                                Ler artigo completo
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <div class="text-sm text-gray-500">
                                Por {{ $post->user->name }}
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>