    <x-app-layout>


        <div class="py-12">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <article class="bg-white shadow-sm sm:rounded-lg p-6 md:p-8">
                    {{-- Cabeçalho do Post --}}
                    <header class="mb-8">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-secondary leading-tight mb-6">
                            {{ $post->title }}
                        </h1>

                        {{-- Autor e Metadados --}}
                        <div class="flex items-center gap-4 mb-6">
                            <a href="{{ route('profile.show', ['user' => $post->user->username]) }}" class="flex-shrink-0">
                                @if ($post->user->image)
                                    <img src="{{ $post->user->image }}" alt="{{ $post->user->name }}"
                                        class="w-12 h-12 rounded-full object-cover ring-2 ring-primary/30 hover:ring-primary/50 transition-all">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                                        <span class="text-primary font-medium">
                                            {{ Str::initials($post->user->name) }}
                                        </span>
                                    </div>
                                @endif
                            </a>

                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-1" x-data="{
                                    following: @json($post->user->isFollowedBy(auth()->user())),
                                    follow() {
                                        this.following = !this.following
                                        axios.post('/follow/{{ auth()->user()->username }}').then(res => res)
                                            .catch(err => {
                                                console.log(err)
                                            })
                                    }
                                }"
                                >
                                    <a href="{{ route('profile.show', ['user' => $post->user->username]) }}"
                                        class="font-medium text-gray-900 hover:text-primary transition-colors">
                                        {{ $post->user->name }}
                                    </a>
                                    @auth
                                        @if (auth()->id() !== $post->user->id)
                                            
                                                <button 
                                                    class="px-3 py-1 text-sm rounded-full transition-colors"
                                                    :class="following ?    'bg-gray-200 text-gray-800 hover:bg-gray-300'
                    : 'bg-primary/10 text-primary hover:bg-primary/20'"
                    @click="follow()"
                    >
                                                <span x-text="following ? 'Deixar de seguir' : 'Seguir'"></span>
                                                </button>
                                        @endif  

                                    @endauth

                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-500">
                                    <span>
                                        {{ $post->readTime() }} min de leitura
                                    </span>
                                    <span>•</span>
                                    <time datetime="{{ $post->published_at }}">
                                        {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y \à\s H:i') }}
                                    </time>
                                </div>
                            </div>
                        </div>

                        {{-- Imagem Destaque --}}
                        <figure class="mb-8">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                        </figure>
                    </header>

                    {{-- Conteúdo do Post --}}
                    <div class="prose max-w-none lg:prose-lg xl:prose-xl mx-auto">
                        {!! $post->content !!}
                    </div>

                    <div class="mt-12 flex items-center gap-2">
                        <span class="text-gray-500">Publicado em:</span>
                        <a href=""
                            class="px-4 py-2 bg-primary/10 text-primary rounded-full hover:bg-primary/20 transition-colors">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    {{-- Interações --}}
                    <footer class="mt-12 pt-8 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                {{-- Likes --}}
                                @auth
                                <button 
                                    x-data="{
                                        liked: @json($post->likes->contains('user_id', auth()->id())),
                                        count: {{ $post->likes->count() }},
                                        toggleLike() {
                                            axios.post('{{ route('post.like', $post->id) }}')
                                                .then(response => {
                                                    this.liked = response.data.liked
                                                    this.count = response.data.likes_count
                                                })
                                                .catch(error => console.error(error))
                                        }
                                    }"
                                    @click.prevent="toggleLike()"
                                    class="like-button group flex items-center gap-2 transition-colors"
                                    :class="liked ? 'text-primary' : 'text-gray-600 hover:text-primary'"
                                >
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                                               2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 
                                               4.5 2.09C13.09 3.81 14.76 3 16.5 3 
                                               19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 
                                               11.54L12 21.35z"
                                        />
                                    </svg>
                                    <span class="like-count text-sm font-medium" x-text="count"></span>
                                </button>
                            @endauth
                            
                                {{-- Shares --}}
                                <button class="flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    <span>2.3k</span>
                                </button>
                                {{-- Cometários --}}
                                <button class="flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>45 Comentários</span>
                                </button>
                            </div>

                            <div class="flex items-center gap-3">
                                {{-- Bookmark --}}
                                <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </button>
                                {{-- Share --}}
                                <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </footer>
                </article>

                {{-- Seção de Comentários (opcional) --}}
                <div class="mt-12 bg-white shadow-sm sm:rounded-lg p-6 md:p-8">
                    <h2 class="text-2xl font-serif font-bold text-secondary mb-6">
                        Comentários (45)
                    </h2>
                    {{-- Aqui viriam os comentários --}}
                </div>
            </div>
        </div>
    </x-app-layout>
