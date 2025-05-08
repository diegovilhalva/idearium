<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Meus Posts</h1>

        @if($posts->count())
            <div class="bg-white shadow-xl rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Título</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Criado em</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 border">
                        @foreach($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-800 font-medium whitespace-nowrap">{{ $post->title }}</td>
                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $post->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 flex flex-wrap gap-2 items-center whitespace-nowrap">
                                    <a href="{{ route('post.show', [$post->user->username, $post]) }}"
                                       class="flex items-center text-primary hover:text-primary/50 font-medium">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Ver
                                    </a>

                                    <a href="{{ route('post.edit', $post) }}"
                                       class="flex items-center text-yellow-600 hover:text-yellow-800 font-medium">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M11 5h2m1 0h4a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h4m1 0V3m0 2v2"/>
                                        </svg>
                                        Editar
                                    </a>

                                    <form action="{{ route('post.destroy', $post) }}" method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja deletar este post?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center text-red-600 hover:text-red-800 font-medium">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Deletar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-gray-600 text-lg">Você ainda não publicou nenhum post.</div>
        @endif
    </div>
</x-app-layout>
