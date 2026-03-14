@if ($paginator->hasPages())
    <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="text-sm text-gray-700 dark:text-white/60 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 ">
            Menampilkan
            <span class="font-medium hover:text-primary dark:hover:text-purple-400 transition-colors duration-200">{{ $paginator->firstItem() }}</span>
            hingga
            <span class="font-medium hover:text-primary dark:hover:text-purple-400 transition-colors duration-200">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-medium hover:text-primary dark:hover:text-purple-400 transition-colors duration-200">{{ $paginator->total() }}</span> 
            <span class="hover:text-primary dark:hover:text-purple-400 transition-colors duration-200">hasil</span>
        </div>

        <div class="flex space-x-2">

            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm font-medium 
                    text-gray-500 dark:text-white/40
                    bg-gray-200 dark:bg-purple-500/10
                    border border-gray-300 dark:border-purple-500/30
                    rounded-lg cursor-not-allowed">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-3 py-1.5 text-sm font-medium 
                   text-gray-700 dark:text-white/80
                   bg-white dark:bg-black
                   border border-gray-300 dark:border-purple-500/30
                   rounded-lg hover:bg-gray-50 dark:hover:bg-purple-500/10 transition">
                    Sebelumnya
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1.5 text-sm font-medium 
                        text-gray-500 dark:text-white/40">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1.5 text-sm font-medium 
                                text-white bg-primary dark:bg-purple-600
                                border border-primary dark:border-purple-600
                                rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-1.5 text-sm font-medium 
                               text-gray-700 dark:text-white/80
                               bg-white dark:bg-black
                               border border-gray-300 dark:border-purple-500/30
                               rounded-lg hover:bg-gray-50 dark:hover:bg-purple-500/10 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-3 py-1.5 text-sm font-medium 
                   text-gray-700 dark:text-white/80
                   bg-white dark:bg-black
                   border border-gray-300 dark:border-purple-500/30
                   rounded-lg hover:bg-gray-50 dark:hover:bg-purple-500/10 transition">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1.5 text-sm font-medium 
                    text-gray-500 dark:text-white/40
                    bg-gray-200 dark:bg-purple-500/10
                    border border-gray-300 dark:border-purple-500/30
                    rounded-lg cursor-not-allowed">
                    Selanjutnya
                </span>
            @endif

        </div>

    </div>
@endif