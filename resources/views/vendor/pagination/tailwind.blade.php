@if ($paginator->hasPages())
    <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        {{-- Info Data --}}
        <div class="text-sm text-gray-700 dark:text-gray-300">
            Menampilkan
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            hingga
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-medium">{{ $paginator->total() }}</span> hasil
        </div>

        {{-- Pagination Links --}}
        <div class="flex space-x-2">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm font-medium 
                    text-gray-500 dark:text-gray-400 
                    bg-gray-200 dark:bg-gray-700 
                    border border-gray-300 dark:border-gray-600 
                    rounded-lg cursor-not-allowed">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-3 py-1.5 text-sm font-medium 
                   text-gray-700 dark:text-gray-200 
                   bg-white dark:bg-gray-800 
                   border border-gray-300 dark:border-gray-600 
                   rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Sebelumnya
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1.5 text-sm font-medium 
                        text-gray-500 dark:text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1.5 text-sm font-medium 
                                text-white bg-primary 
                                border border-primary 
                                rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-1.5 text-sm font-medium 
                               text-gray-700 dark:text-gray-200 
                               bg-white dark:bg-gray-800 
                               border border-gray-300 dark:border-gray-600 
                               rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-3 py-1.5 text-sm font-medium 
                   text-gray-700 dark:text-gray-200 
                   bg-white dark:bg-gray-800 
                   border border-gray-300 dark:border-gray-600 
                   rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1.5 text-sm font-medium 
                    text-gray-500 dark:text-gray-400 
                    bg-gray-200 dark:bg-gray-700 
                    border border-gray-300 dark:border-gray-600 
                    rounded-lg cursor-not-allowed">
                    Selanjutnya
                </span>
            @endif

        </div>

    </div>
@endif
