<article class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow duration-200">
    <a href="{{route('post.show',['username' => $post->user->username, 'post' => $post->slug])}}" class="block">
        @if($post->image)
        <img class="w-full h-48 object-cover" 
             src="{{  $post->image }}" 
             alt="{{ $post->title }}">
        @else
        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
            <span class="text-gray-400">Sem imagem</span>
        </div>
        @endif
    </a>
    
    <div class="p-6">
        <div class="mb-3 flex items-center justify-between">
            <a href="{{route('post.byCategory',$post->category->slug)}}" 
               class="text-sm text-primary hover:text-secondary transition-colors">
                {{ $post->category->name }}
            </a>
            <time datetime="{{ $post->published_at }}" 
                  class="text-sm text-gray-500">
                  {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y \à\s H:i') }}
            </time>
        </div>
        
        <a href="{{route('post.show',['username' => $post->user->username, 'post' => $post->slug])}}">
            <h3 class="text-xl font-serif font-bold text-secondary mb-2 leading-tight">
                {{ $post->title }}
            </h3>
        </a>
        
        <p class="text-gray-600 mb-4 line-clamp-3">
            {{ Str::limit(strip_tags($post->content), 150) }}
        </p>
        
        <div class="flex items-center justify-between">
            <a href="{{route('post.show',['username' => $post->user->username, 'post' => $post->slug])}}" 
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