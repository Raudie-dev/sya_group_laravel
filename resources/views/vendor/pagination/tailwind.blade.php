@if ($paginator->hasPages())
    <nav class="flex items-center justify-between gap-4" aria-label="Paginación">

        {{-- Info --}}
        <p class="text-xs text-gray-400">
            Mostrando
            <span class="font-semibold text-blue-dark">{{ $paginator->firstItem() }}</span>
            –
            <span class="font-semibold text-blue-dark">{{ $paginator->lastItem() }}</span>
            de
            <span class="font-semibold text-blue-dark">{{ $paginator->total() }}</span>
            resultados
        </p>

        {{-- Botones --}}
        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-blue-dark hover:text-white hover:border-blue-dark transition-all duration-150 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex items-center justify-center w-8 h-8 text-xs text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-dark text-white text-xs font-bold shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white text-gray-600 text-xs font-medium hover:bg-blue-dark hover:text-white hover:border-blue-dark transition-all duration-150 shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-blue-dark hover:text-white hover:border-blue-dark transition-all duration-150 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif

        </div>
    </nav>
@endif