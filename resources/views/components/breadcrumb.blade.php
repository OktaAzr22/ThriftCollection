@php
    if (request()->is('dashboard')) return;
@endphp

@props([
    'segments' => request()->segments(),
])

<div class="mb-6 flex items-center text-sm text-slate-500">

    

    <a href="{{ url('/dashboard') }}" class="hover:text-blue-600 font-medium transition">
        <i class="fas fa-home mr-1"></i> Beranda
    </a>

    @foreach ($segments as $index => $seg)
        @php
            $url = url(implode('/', array_slice($segments, 0, $index + 1)));
            $name = ucfirst(str_replace('-', ' ', $seg));
            $isLast = $index === count($segments) - 1;
        @endphp

        <i class="fas fa-chevron-right text-xs mx-3 text-slate-400"></i>

        @if ($isLast)
            <span class="font-medium text-slate-700">
                {{ $name }}
            </span>
        @else
            <a href="{{ $url }}" class="hover:text-blue-600 transition">
                {{ $name }}
            </a>
        @endif

    @endforeach

</div>