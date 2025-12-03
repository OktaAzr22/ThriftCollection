@php
    if (request()->is('dashboard')) return;
@endphp

@props([
    'segments' => request()->segments(),
])

<div class="mb-6">
    <nav class="flex justify-end" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">

            {{-- HOME --}}
            <li class="inline-flex items-center">
                <a href="{{ url('/dashboard') }}"
                   class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary transition-colors duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
            </li>

            {{-- DYNAMIC SEGMENTS --}}
            @foreach ($segments as $index => $seg)
                @php
                    $url = url(implode('/', array_slice($segments, 0, $index + 1)));
                    $name = ucfirst(str_replace('-', ' ', $seg));
                    $isLast = $index === count($segments) - 1;
                @endphp

                <li aria-current="{{ $isLast ? 'page' : false }}">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>

                        @if ($isLast)
                            <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">
                                {{ $name }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="ml-1 text-sm font-medium text-gray-500 hover:text-primary transition md:ml-2">
                                {{ $name }}
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach

        </ol>
    </nav>
</div>
