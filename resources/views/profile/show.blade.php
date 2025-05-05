<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
                    {{-- Sidebar --}}
                    <div class="md:col-span-1 space-y-6" x-data="{
                        following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                        followersCount:{{$user->followers()->count()}},
                        follow() {
                            this.following = !this.following
                          axios.post('/follow/{{ $user->username }}').then(res => {
                                    this.followersCount = res.data.followersCount})
                                .catch(err => {
                                    console.log(err)
                                })
                        }
                    }">
                        <div class="border-b pb-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ $user->image ?: 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=1a8917&background=e5f5e8' }}"
                                    alt="{{ $user->name }}"
                                    class="w-12 h-12 rounded-full object-cover border-4 border-primary/20">
                                <div>
                                    <h1 class="text-2xl font-serif font-bold text-secondary">{{ $user->name }}</h1>
                                    <p class="text-gray-500 mt-1">{{ '@' . $user->username }}</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-4">
                                <div class="flex items-center gap-4 text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="font-medium"> <span x-text="followersCount"></span>  seguidores</span>
                                </div>

                                @if ($user->bio)
                                    <div class="prose text-gray-600 line-clamp-3" x-data="{ expanded: false }">
                                        <p x-bind:class="!expanded && 'line-clamp-3'">{{ $user->bio }}</p>
                                        <button @click="expanded = !expanded"
                                            class="text-primary hover:text-secondary mt-2 text-sm">
                                            <span x-text="expanded ? 'Ver menos' : 'Ver mais'"></span>
                                        </button>
                                    </div>
                                @endif
                                @if (auth()->user() && auth()->user()->id !== $user->id)
                                    <button
                                        class="w-full px-6 py-3 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 
                                transition-colors font-medium flex items-center justify-center gap-2"
                                        @click="follow()">

                                        <template x-if="!following">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <!-- Ícone de seguir (sinal de +) -->
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </template>
                                        <template x-if="following">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <!-- Ícone de deixar de seguir (sinal de -) -->
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4" />
                                            </svg>
                                        </template>
                                        

                                        <span x-text="following ? 'Deixar de seguir' : 'Seguir'"></span>

                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Main Content --}}
                    <div class="md:col-span-2 space-y-8">
                        @forelse ($posts as $post)
                            <article
                                class="bg-white overflow-hidden shadow-sm rounded-xl hover:shadow-md transition-shadow">
                                <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                                    class="block">
                                    @if ($post->image)
                                        <img class="w-full h-48 object-cover" src="{{ $post->image }}"
                                            alt="{{ $post->title }}">
                                    @else
                                        <div class="w-full h-48 bg-gray-50 flex items-center justify-center">
                                            <span class="text-gray-400">Sem imagem</span>
                                        </div>
                                    @endif
                                </a>

                                <div class="p-6 space-y-4">
                                    <div class="flex items-center justify-between">
                                        <a href=""
                                            class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm 
                                                  hover:bg-primary/20 transition-colors">
                                            {{ $post->category->name }}
                                        </a>
                                        <time datetime="{{ $post->published_at }}" class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y \à\s H:i') }}
                                        </time>
                                    </div>

                                    <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                                        class="block">
                                        <h3 class="text-2xl font-serif font-bold text-secondary leading-tight">
                                            {{ $post->title }}
                                        </h3>
                                        <p class="mt-2 text-gray-600 line-clamp-2">
                                            {{ Str::limit(strip_tags($post->content), 150) }}
                                        </p>
                                    </a>

                                    <div class="flex items-center justify-between pt-4">
                                        <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                                            class="inline-flex items-center text-primary hover:text-secondary transition-colors">
                                            Ler artigo completo
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                        <div class="text-sm text-gray-500">
                                            Por
                                            <a href="{{ route('profile.show', $post->user->username) }}"
                                                class="hover:text-primary transition-colors">
                                                {{ $post->user->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="text-center py-12">
                                <svg class="w-24 h-24 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-4 text-xl font-medium text-gray-900">Nenhum post publicado ainda</h3>
                                <p class="mt-1 text-gray-500">Quando {{ $user->name }} publicar algo, aparecerá aqui.
                                </p>
                            </div>
                        @endforelse
                        <div class="mt-8">
                            {{ $posts->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
