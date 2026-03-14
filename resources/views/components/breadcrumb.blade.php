@php
    if (request()->is('dashboard')) return;
@endphp

@props([
    'segments' => request()->segments(),
])

<div class="mb-6 flex items-center text-sm text-slate-500 dark:text-white/60">

    

    <a href="{{ url('/dashboard') }}" class="hover:text-blue-600 dark:text-white/80 dark:hover:text-purple-400 font-medium transition">
        <i class="fas fa-home mr-1"></i> Beranda
    </a>

    @foreach ($segments as $index => $seg)
        @php
            $url = url(implode('/', array_slice($segments, 0, $index + 1)));
            $name = ucfirst(str_replace('-', ' ', $seg));
            $isLast = $index === count($segments) - 1;
        @endphp

        <i class="fas fa-chevron-right text-xs mx-3 text-slate-400 dark:text-purple-400/60"></i>

        @if ($isLast)
            <span class="font-medium text-slate-700 dark:text-white">
                {{ $name }}
            </span>
        @else
            <a href="{{ $url }}" class="hover:text-blue-600 dark:text-white/80 dark:hover:text-purple-400 transition">
                {{ $name }}
            </a>
        @endif

    @endforeach

</div>