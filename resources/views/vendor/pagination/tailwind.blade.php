@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navegação de paginação" class="mt-8">
        {{-- Mobile --}}
        <div class="flex justify-between items-center sm:hidden space-x-4">
            @if ($paginator->onFirstPage())
                <span class="flex-1 text-center px-4 py-2 text-gray-400 bg-gray-50 rounded-lg cursor-not-allowed">
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="flex-1 text-center px-4 py-2 text-primary bg-white border border-primary/20 rounded-lg hover:bg-primary/10 transition-colors">
                    Anterior
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="flex-1 text-center px-4 py-2 text-primary bg-white border border-primary/20 rounded-lg hover:bg-primary/10 transition-colors">
                    Próximo
                </a>
            @else
                <span class="flex-1 text-center px-4 py-2 text-gray-400 bg-gray-50 rounded-lg cursor-not-allowed">
                    Próximo
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div class="text-sm text-gray-600">
                Mostrando 
                <span class="font-medium text-primary">{{ $paginator->firstItem() }}</span>
                a 
                <span class="font-medium text-primary">{{ $paginator->lastItem() }}</span>
                de 
                <span class="font-medium text-primary">{{ $paginator->total() }}</span>
                resultados
            </div>

            <div class="relative z-0 inline-flex shadow-sm">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-2 text-gray-300 bg-white border border-gray-200 cursor-default rounded-l-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-primary bg-white border border-gray-200 rounded-l-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                @endif

                {{-- Pages --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="relative inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-400">
                            ...
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="relative inline-flex items-center px-4 py-2 bg-primary text-white border border-primary">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-primary bg-white border border-gray-200 rounded-r-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <span class="relative inline-flex items-center px-2 py-2 text-gray-300 bg-white border border-gray-200 cursor-default rounded-r-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif