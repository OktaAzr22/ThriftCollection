@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <a href="{{ route('brands.index') }}" class="text-blue-600 underline">
        &larr; Kembali
    </a>

    <h1 class="text-2xl font-bold mt-4 mb-6">
        Items from Brand: {{ $brand->name }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        @forelse($items as $item)
            <div class="border shadow rounded p-4">
                <h2 class="text-lg font-semibold">{{ $item->name }}</h2>
                <p class="text-gray-600">{{ $item->description }}</p>
                <p class="mt-2 text-sm text-gray-800">
                    Harga: Rp {{ number_format($item->price) }}
                </p>
            </div>
        @empty
            <p class="col-span-3 text-gray-500">
                Tidak ada item di brand ini.
            </p>
        @endforelse

    </div>

</div>



                 
@endsection
